@extends('layouts.master')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-container {
        max-width: 800px;
        width: 100%;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .success-card {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .success-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .success-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
        animation: scaleIn 0.5s ease-out;
    }

    .success-icon.paid {
        color: #28a745;
    }

    .success-icon.pending {
        color: #ffc107;
    }

    @keyframes scaleIn {
        0% {
            transform: scale(0);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a2332;
        margin-bottom: 0.5rem;
    }

    .success-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .order-info-card {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        margin: 2rem 0;
        border: 2px solid #dee2e6;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #6c757d;
    }

    .info-value {
        font-weight: 700;
        color: #1a2332;
    }

    .status-badge {
        display: inline-block;
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .status-paid {
        background: #28a745;
        color: white;
    }

    .status-pending {
        background: #ffc107;
        color: #000;
    }

    .status-failed {
        background: #dc3545;
        color: white;
    }

    .order-items-section {
        margin: 2rem 0;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 3px solid #FFD700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .item-card {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 0.75rem;
        border: 1px solid #dee2e6;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .item-info {
        flex: 1;
    }

    .item-name {
        font-weight: 700;
        color: #1a2332;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }

    .item-details {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .item-price {
        font-weight: 700;
        color: #1a2332;
        font-size: 1.2rem;
    }

    .total-section {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin: 2rem 0;
        text-align: center;
    }

    .total-label {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        opacity: 0.9;
    }

    .total-amount {
        font-size: 2.5rem;
        font-weight: 900;
        color: #FFD700;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-action {
        flex: 1;
        padding: 1rem 2rem;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-whatsapp {
        background: #25D366;
        color: white;
    }

    .btn-whatsapp:hover {
        background: #20BA5A;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
        color: white;
    }

    .btn-continue {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
    }

    .btn-continue:hover {
        background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        color: white;
    }

    .btn-home {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a2332;
    }

    .btn-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 215, 0, 0.4);
        color: #1a2332;
    }

    .note-section {
        text-align: center;
        margin-top: 2rem;
        padding: 1rem;
        background: #fff3cd;
        border-radius: 8px;
        border: 1px solid #ffc107;
    }

    .note-section i {
        color: #ffc107;
        margin-right: 0.5rem;
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }

        .success-card {
            padding: 2rem 1.5rem;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        {{-- Header --}}
        <div class="success-header">
            @if($order->status == 'paid')
                <div class="success-icon paid">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h1 class="success-title">Payment Successful!</h1>
                <p class="success-subtitle">Your payment has been confirmed</p>
            @else
                <div class="success-icon pending">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <h1 class="success-title">Payment Pending</h1>
                <p class="success-subtitle">Waiting for payment confirmation</p>
            @endif
        </div>

        {{-- Order Information --}}
        <div class="order-info-card">
            <div class="info-row">
                <span class="info-label">Order Number</span>
                <span class="info-value">{{ $order->order_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Order Date</span>
                <span class="info-value">{{ $order->created_at->format('d M Y, H:i') }} WIB</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span>
                    <span class="status-badge status-{{ $order->status }}">
                        {{ strtoupper($order->status) }}
                    </span>
                </span>
            </div>
            @if($order->payment_type)
            <div class="info-row">
                <span class="info-label">Payment Method</span>
                <span class="info-value">{{ ucwords(str_replace('_', ' ', $order->payment_type)) }}</span>
            </div>
            @endif
        </div>

        {{-- Total Amount --}}
        <div class="total-section">
            <div class="total-label">Total Amount</div>
            <div class="total-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
        </div>

        {{-- Order Items --}}
        <div class="order-items-section">
            <h3 class="section-title">
                <i class="bi bi-bag-check"></i>
                Order Items ({{ $order->items->count() }})
            </h3>

            @foreach($order->items as $item)
                <div class="item-card">
                    <div class="item-row">
                        <div class="item-info">
                            <div class="item-name">{{ $item->product->name_product }}</div>
                            <div class="item-details">
                                Quantity: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="item-price">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Action Buttons --}}
        <div class="action-buttons">
            @if($order->status == 'pending')
                {{-- Show Continue Payment button for pending orders --}}
                <a href="{{ route('checkout.retry', $order->order_number) }}" 
                   class="btn-action btn-continue">
                    <i class="bi bi-credit-card-fill"></i>
                    Continue Payment
                </a>
            @endif
            
            <a href="https://wa.me/{{ $whatsappNumber }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20order%20{{ $order->order_number }}" 
               target="_blank" 
               class="btn-action btn-whatsapp">
                <i class="bi bi-whatsapp"></i>
                Contact Seller
            </a>
            <a href="/" class="btn-action btn-home">
                <i class="bi bi-house-fill"></i>
                Back to Home
            </a>
        </div>

        {{-- Note Section --}}
        <div class="note-section">
            <i class="bi bi-info-circle-fill"></i>
            @if($order->status == 'paid')
                <strong>Payment Successful!</strong> Contact seller for more information about your order.
            @else
                <strong>Note:</strong> Please complete your payment to process your order.
            @endif
        </div>
    </div>
</div>

@endsection
