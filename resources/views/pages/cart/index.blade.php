@extends('layouts.master')

@section('content')

{{-- Page Header --}}
<div class="page-header-modern">
    <div class="page-header-overlay">
        <div class="container">
            <h1 class="page-header-title"><i class="bi bi-cart3 me-3"></i>Shopping Cart</h1>
            <p class="page-header-subtitle">Review your selected items</p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 3rem;">

<style>
    /* Page Header Modern */
    .page-header-modern {
        background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(44, 62, 80, 0.92) 100%),
                    url('https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?q=80&w=2070') center/cover;
        padding: 120px 0 90px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        width: 100%;
        margin: 0;
    }

    .page-header-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 10px,
            rgba(255, 215, 0, 0.02) 10px,
            rgba(255, 215, 0, 0.02) 20px
        );
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
            rgba(248, 249, 250, 0.05) 20%,
            rgba(248, 249, 250, 0.15) 40%,
            rgba(248, 249, 250, 0.35) 60%,
            rgba(248, 249, 250, 0.65) 80%,
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

    .cart-header {
        display: none;
    }

    .cart-item {
        background: white;
        border: 2px solid #1a2332;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .cart-item img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 5px;
    }

    .quantity-input {
        width: 60px;
        border: 2px solid #1a2332;
        border-radius: 5px;
        text-align: center;
        font-weight: 700;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-quantity {
        background-color: #1a2332;
        color: #FFD700;
        border: 2px solid #1a2332;
        width: 35px;
        height: 35px;
        border-radius: 5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-quantity:hover {
        background-color: #FFD700;
        color: #1a2332;
    }

    .btn-remove {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .btn-remove:hover {
        background-color: #c82333;
    }

    .cart-total {
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #1a2332;
        padding: 2rem;
        border-radius: 10px;
        margin-top: 2rem;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .btn-checkout {
        background-color: #1a2332;
        color: #FFD700;
        border: 2px solid #FFD700;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s;
        cursor: not-allowed;
    }

    .btn-checkout:hover {
        background-color: #FFD700;
        color: #1a2332;
    }

    .empty-cart {
        text-align: center;
        padding: 3rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .empty-cart i {
        font-size: 5rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }
</style>

<div class="cart-header">
    <h1><i class="bi bi-cart4"></i> Shopping Cart</h1>
</div>

{{-- Success message --}}
@if(session('Message'))
    <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
        <strong>Success!</strong> {{ session('Message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Error message --}}
@if(session('Error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('Error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Validation errors --}}
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($cartItems->count() > 0)
    {{-- Cart Items --}}
    @foreach($cartItems as $item)
        <div class="cart-item">
            <div class="row align-items-center">
                <div class="col-md-2">
                    @if($item->product->image_product)
                        <img src="{{ asset('storage/' . $item->product->image_product) }}" alt="{{ $item->product->name_product }}">
                    @else
                        <div style="width: 100px; height: 100px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-image" style="font-size: 2rem; color: #999;"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <h5 style="color: #1a2332; font-weight: 700;">{{ $item->product->name_product }}</h5>
                    <p class="mb-1"><small><strong>Category:</strong> {{ $item->product->category->category_name }}</small></p>
                    <p class="mb-0"><small><strong>Branch:</strong> {{ $item->product->branch->name_branch }}</small></p>
                </div>
                <div class="col-md-2">
                    <p class="mb-0" style="font-weight: 700; color: #1a2332;">
                        Rp {{ number_format($item->product->price_product, 0, ',', '.') }}
                    </p>
                </div>
                <div class="col-md-2">
                    <div class="quantity-controls">
                        <form action="{{ route('cart.update', $item->id_cart) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                            <button type="submit" class="btn-quantity" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                        </form>
                        
                        <input type="text" value="{{ $item->quantity }}" class="quantity-input" readonly>
                        
                        <form action="{{ route('cart.update', $item->id_cart) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            <button type="submit" class="btn-quantity" {{ $item->quantity >= $item->product->stock_product ? 'disabled' : '' }}>+</button>
                        </form>
                    </div>
                    <small class="text-muted d-block mt-1">Max: {{ $item->product->stock_product }}</small>
                </div>
                <div class="col-md-2 text-end">
                    <p class="mb-2" style="font-weight: 700; color: #1a2332; font-size: 1.1rem;">
                        Rp {{ number_format($item->product->price_product * $item->quantity, 0, ',', '.') }}
                    </p>
                    <form action="{{ route('cart.destroy', $item->id_cart) }}" method="POST" style="display: inline;" onsubmit="return confirm('Remove this item from cart?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-remove">
                            <i class="bi bi-trash"></i> Remove
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Total and Checkout --}}
    <div class="cart-total text-center">
        <p class="mb-3">TOTAL: Rp {{ number_format($total, 0, ',', '.') }}</p>
        <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
            @csrf
            <button type="submit" class="btn-checkout">
                <i class="bi bi-credit-card"></i> Checkout Now
            </button>
        </form>
    </div>

    <script>
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        // Show loading indicator
        const btn = this.querySelector('button');
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Processing...';
    });
    </script>

@else
    {{-- Empty Cart --}}
    <div class="empty-cart">
        <i class="bi bi-cart-x"></i>
        <h3 style="color: #6c757d;">Your cart is empty</h3>
        <p class="text-muted">Start shopping to add items to your cart!</p>
        <a href="/product" class="btn btn-primary" style="background-color: #1a2332; border-color: #1a2332; color: #FFD700; font-weight: 700;">
            Browse Products
        </a>
    </div>
@endif

@endsection
