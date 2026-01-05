@extends('layouts.master')

@section('content')

{{-- Page Header --}}
<div class="page-header-modern">
    <div class="page-header-overlay">
        <div class="container">
            <h1 class="page-header-title"><i class="bi bi-credit-card me-3"></i>Checkout</h1>
            <p class="page-header-subtitle">Review your order before payment</p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 3rem; margin-bottom: 5rem;">

<style>
    /* Page Header */
    .page-header-modern {
        background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(44, 62, 80, 0.92) 100%),
                    url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=2070') center/cover;
        padding: 120px 0 90px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        width: 100%;
        margin: 0;
    }

    .page-header-modern::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: linear-gradient(to bottom, 
            rgba(248, 249, 250, 0) 0%,
            rgba(248, 249, 250, 0.90) 92%,
            #f8f9fa 100%
        );
    }

    .page-header-overlay {
        position: relative;
        z-index: 1;
    }

    .page-header-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page-header-subtitle {
        font-size: 1.3rem;
        opacity: 0.95;
        color: rgba(255, 255, 255, 0.9);
    }

    .checkout-card {
        background: white;
        border: 2px solid #1a2332;
        border-radius: 12px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .checkout-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #FFD700;
    }

    .order-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        gap: 1rem;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #dee2e6;
    }

    .order-item-details {
        flex: 1;
    }

    .order-item-name {
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 0.25rem;
    }

    .order-item-quantity {
        color: #6c757d;
        font-size: 0.9rem;
    }

    .order-item-price {
        font-weight: 700;
        color: #1a2332;
        font-size: 1.1rem;
    }

    .order-summary {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 8px;
        border: 2px solid #dee2e6;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #dee2e6;
    }

    .summary-row:last-child {
        border-bottom: none;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px solid #1a2332;
    }

    .summary-total {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a2332;
    }

    .btn-pay {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        color: #FFD700;
        border: none;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 8px;
        transition: all 0.3s;
        width: 100%;
        cursor: pointer;
    }

    .btn-pay:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(26, 35, 50, 0.3);
        color: #FFD700;
    }

    .btn-back {
        background: white;
        color: #1a2332;
        border: 2px solid #1a2332;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #1a2332;
        color: #FFD700;
    }
</style>

<div class="row">
    <div class="col-lg-8">
        {{-- Order Items --}}
        <div class="checkout-card">
            <h2 class="checkout-title">
                <i class="bi bi-bag-check me-2"></i>Order Items ({{ $cartItems->count() }})
            </h2>
            
            @foreach ($cartItems as $item)
                <div class="order-item">
                    <img src="{{ optional($item->product->images->first())->image_path ?? 'https://via.placeholder.com/80?text=No+Image' }}" alt="{{ $item->product->name_product }}">
                    <div class="order-item-details">
                        <div class="order-item-name">{{ $item->product->name_product }}</div>
                        <div class="order-item-quantity">Quantity: {{ $item->quantity }} × Rp {{ number_format($item->product->price_product, 0, ',', '.') }}</div>
                    </div>
                    <div class="order-item-price">
                        Rp {{ number_format($item->product->price_product * $item->quantity, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Order Summary --}}
        <div class="checkout-card">
            <h2 class="checkout-title">
                <i class="bi bi-receipt me-2"></i>Order Summary
            </h2>
            
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span style="font-weight: 600;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span style="font-weight: 600;">Rp 0</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span style="font-weight: 600;">FREE</span>
                </div>
                <div class="summary-row">
                    <span class="summary-total">Total</span>
                    <span class="summary-total" style="color: #FFD700;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST" style="margin-top: 1.5rem;">
                @csrf
                <button type="submit" class="btn-pay">
                    <i class="bi bi-lock-fill me-2"></i>Pay with Midtrans
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('cart.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left me-2"></i>Back to Cart
                </a>
            </div>

            <div class="mt-4 text-center">
                <small class="text-muted">
                    <i class="bi bi-shield-check me-1"></i>
                    Secure payment powered by Midtrans
                </small>
            </div>
        </div>
    </div>
</div>

</div>

@endsection
