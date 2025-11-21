@extends('layouts.master')

@section('content')
<style>
    .cart-header {
        background: linear-gradient(135deg, #1a2332 0%, #2a3545 100%);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        text-align: center;
    }

    .cart-header h1 {
        color: #FFD700;
        margin: 0;
        font-weight: 700;
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
        width: 80px;
        border: 2px solid #1a2332;
        border-radius: 5px;
        text-align: center;
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
                    <form action="/cart/{{ $item->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="quantity-input" onchange="this.form.submit()">
                    </form>
                </div>
                <div class="col-md-2 text-end">
                    <p class="mb-2" style="font-weight: 700; color: #1a2332; font-size: 1.1rem;">
                        Rp {{ number_format($item->product->price_product * $item->quantity, 0, ',', '.') }}
                    </p>
                    <form action="/cart/{{ $item->id }}" method="POST" style="display: inline;">
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
        <button class="btn-checkout" disabled title="Checkout feature coming soon">
            <i class="bi bi-credit-card"></i> Checkout
        </button>
        <p class="mt-2 mb-0" style="font-size: 0.9rem; font-weight: 400;">
            <small>*Checkout button is placeholder only</small>
        </p>
    </div>

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
