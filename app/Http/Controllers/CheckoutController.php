<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductModel;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

/**
 * Checkout Controller - Handles order creation and Midtrans payment
 * 
 * Protected by: CustomerMiddleware (only role='customer' can access)
 * 
 * Features:
 * - Display checkout page with order summary
 * - Create order and generate Midtrans Snap Token
 * - Handle payment callback from Midtrans
 * - Update order status based on payment result
 */
class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set Midtrans Configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    /**
     * Display checkout page with cart items summary
     */
    public function index()
    {
        $cartItems = Cart::where('id_user', Auth::id())
            ->with(['product.branch', 'product.category', 'product.images'])
            ->get();

        // If cart is empty, redirect back to cart page
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->product->price_product * $item->quantity;
        });

        return view('pages.checkout.index', compact('cartItems', 'total'));
    }

    /**
     * Create order and generate Midtrans Snap Token
     */
    public function process(Request $request)
    {
        try {
            DB::beginTransaction();

            // Get cart items for current user
            $cartItems = Cart::where('id_user', Auth::id())
                ->with('product')
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->with('error', 'Your cart is empty!');
            }

            // Check stock availability
            foreach ($cartItems as $item) {
                if ($item->product->stock_product < $item->quantity) {
                    return redirect()->route('cart.index')
                        ->with('error', "Insufficient stock for {$item->product->name_product}");
                }
            }

            // Calculate total amount
            $totalAmount = $cartItems->sum(function ($item) {
                return $item->product->price_product * $item->quantity;
            });

            // Create order
            $order = Order::create([
                'id_user' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending'
            ]);

            // Create order items and reduce stock
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'id_order' => $order->id_order,
                    'id_product' => $item->id_product,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price_product,
                    'subtotal' => $item->product->price_product * $item->quantity
                ]);

                // Reduce product stock
                $product = ProductModel::find($item->id_product);
                $product->stock_product -= $item->quantity;
                $product->save();
            }

            // Prepare Midtrans transaction parameters
            $user = Auth::user();
            $params = [
                'transaction_details' => [
                    'order_id' => $order->order_number,
                    'gross_amount' => (int) $totalAmount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email ?? 'customer@example.com',
                    'phone' => $user->phone ?? '08123456789',
                ],
                'item_details' => $cartItems->map(function ($item) {
                    return [
                        'id' => $item->id_product,
                        'price' => (int) $item->product->price_product,
                        'quantity' => $item->quantity,
                        'name' => $item->product->name_product
                    ];
                })->toArray()
            ];

            // Get Snap Token from Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Save snap token to order
            $order->snap_token = $snapToken;
            $order->save();

            // Clear cart after order created
            Cart::where('id_user', Auth::id())->delete();

            DB::commit();

            // Return HTML with auto-trigger Snap popup
            return view('pages.checkout.snap-trigger', compact('order', 'snapToken'));

        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->route('cart.index')
                ->with('error', 'Failed to process order: ' . $e->getMessage());
        }
    }

    /**
     * Handle Midtrans notification callback
     * Called by Midtrans server when payment status changes
     */
    public function callback(Request $request)
    {
        try {
            // Create notification instance
            $notification = new Notification();

            // Get transaction details
            $transactionStatus = $notification->transaction_status;
            $orderNumber = $notification->order_id;
            $fraudStatus = $notification->fraud_status;

            // Find order
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Update order based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->status = 'paid';
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->status = 'paid';
            } elseif ($transactionStatus == 'pending') {
                $order->status = 'pending';
            } elseif ($transactionStatus == 'deny') {
                $order->status = 'failed';
                
                // Restore stock
                $this->restoreStock($order);
            } elseif ($transactionStatus == 'expire') {
                $order->status = 'expired';
                
                // Restore stock
                $this->restoreStock($order);
            } elseif ($transactionStatus == 'cancel') {
                $order->status = 'cancelled';
                
                // Restore stock
                $this->restoreStock($order);
            }

            // Save transaction details
            $order->transaction_id = $notification->transaction_id;
            $order->payment_type = $notification->payment_type;
            $order->transaction_time = $notification->transaction_time;
            $order->payment_response = json_encode($notification->getResponse());
            $order->save();

            return response()->json(['message' => 'Notification handled successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show order success page
     */
    public function success(Request $request)
    {
        $orderNumber = $request->order_id;
        $order = Order::where('order_number', $orderNumber)
            ->where('id_user', Auth::id())
            ->with('items.product')
            ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        // Update status to paid if payment successful from frontend
        if ($request->payment_status === 'success' && $order->status === 'pending') {
            $order->status = 'paid';
            $order->save();
        }

        // WhatsApp contact number from footer
        $whatsappNumber = '6287819953555';

        return view('pages.checkout.success', compact('order', 'whatsappNumber'));
    }

    /**
     * Retry payment for pending order
     */
    public function retryPayment($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('id_user', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found or already paid');
        }

        if (!$order->snap_token) {
            return redirect()->route('home')->with('error', 'Payment token not found');
        }

        // Re-trigger payment with existing snap token
        $snapToken = $order->snap_token;
        return view('pages.checkout.snap-trigger', compact('order', 'snapToken'));
    }

    /**
     * Restore product stock when order failed/expired/cancelled
     */
    private function restoreStock(Order $order)
    {
        foreach ($order->items as $item) {
            $product = ProductModel::find($item->id_product);
            if ($product) {
                $product->stock_product += $item->quantity;
                $product->save();
            }
        }
    }
}
