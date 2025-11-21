<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\ProductModel;

/**
 * Cart Controller - Handles shopping cart operations for customers
 * 
 * Protected by: CustomerMiddleware (only role='customer' can access)
 * Routes: /cart (GET, POST, PUT, DELETE)
 * 
 * Features:
 * - View all cart items for logged-in customer
 * - Add product to cart (or increase quantity if exists)
 * - Update cart item quantity
 * - Remove item from cart
 */
class CartController extends Controller
{
    /**
     * Display customer's shopping cart with all items
     * Auth::id() gets the current logged-in user's ID
     */
    public function index()
    {
        // Get all cart items for current logged-in customer with product details
        // Auth::id() = current user's ID from session
        // with() = eager load relationships to avoid N+1 queries
        $cartItems = Cart::where('user_id', Auth::id())
            ->with(['product.branch', 'product.category'])
            ->get();

        // Calculate total price: sum of (price * quantity) for each item
        $total = $cartItems->sum(function ($item) {
            return $item->product->price_product * $item->quantity;
        });

        // Pass cart items and total to view
        return view('pages.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     * If product already in cart, increase quantity
     * Called from: Product detail page "Add to Cart" button
     */
    public function store(Request $request)
    {
        // Validate input: product must exist in database, quantity >= 1
        $request->validate([
            'id_product' => 'required|exists:tb_product,id_product',
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if product already in cart for current user
        // Auth::id() = current logged-in user's ID
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('id_product', $request->id_product)
            ->first();

        if ($cartItem) {
            // Product exists in cart, increase quantity
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
            $message = 'Cart quantity updated!';
        } else {
            // Add new product to cart (first time adding this product)
            Cart::create([
                'user_id' => Auth::id(), // Current user's ID
                'id_product' => $request->id_product,
                'quantity' => $request->quantity
            ]);
            $message = 'Product added to cart!';
        }

        // Redirect back to previous page with success message
        return redirect()->back()->with('Message', $message);
    }

    /**
     * Update cart item quantity
     * Called from: Cart page when customer changes quantity
     */
    public function update(Request $request, $id)
    {
        // Validate: quantity must be at least 1, must be integer, max 9999
        $request->validate([
            'quantity' => 'required|integer|min:1|max:9999'
        ], [
            'quantity.required' => 'Quantity is required!',
            'quantity.integer' => 'Quantity must be a valid number!',
            'quantity.min' => 'Quantity must be at least 1!',
            'quantity.max' => 'Quantity cannot exceed 9999!'
        ]);

        // Find cart item belonging to current user
        // Auth::id() ensures customer can only update their own cart
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        
        // Check if quantity exceeds available stock
        $product = ProductModel::findOrFail($cartItem->id_product);
        if ($request->quantity > $product->stock_product) {
            return redirect('/cart')->with('Error', 'Quantity exceeds available stock! Only ' . $product->stock_product . ' items available.');
        }
        
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect('/cart')->with('Message', 'Cart updated!');
    }

    /**
     * Remove item from cart
     * Called from: Cart page "Remove" button
     */
    public function destroy($id)
    {
        // Find cart item belonging to current user
        // Auth::id() prevents customers from deleting other users' cart items
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect('/cart')->with('Message', 'Item removed from cart!');
    }
}
