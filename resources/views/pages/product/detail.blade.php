@extends('layouts.master')

@section('content')
<style>
    .product-detail-header {
        background: linear-gradient(135deg, #1a2332 0%, #2a3545 100%);
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }

    .product-detail-card {
        background: white;
        border: 2px solid #1a2332;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .product-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }

    .product-info {
        padding: 2rem;
    }

    .product-title {
        color: #1a2332;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .product-price {
        color: #FFD700;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .info-label {
        color: #666;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: #1a2332;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
    }

    .btn-add-cart {
        background-color: #FFD700;
        color: #1a2332;
        border: 2px solid #1a2332;
        padding: 1rem 3rem;
        font-size: 1.2rem;
        font-weight: 700;
        border-radius: 10px;
        transition: all 0.3s;
    }

    .btn-add-cart:hover {
        background-color: #1a2332;
        color: #FFD700;
    }

    .btn-back {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-back:hover {
        background-color: #5a6268;
        color: white;
    }

    .stock-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
    }

    .stock-available {
        background-color: #28a745;
        color: white;
    }

    .stock-low {
        background-color: #ffc107;
        color: #1a2332;
    }

    .stock-out {
        background-color: #dc3545;
        color: white;
    }
</style>

<div class="product-detail-header">
    <h1 style="color: #FFD700; margin: 0;"><i class="bi bi-box-seam"></i> Product Details</h1>
</div>

{{-- Success message --}}
@if(session('Message'))
    <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
        <strong>Success!</strong> {{ session('Message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="product-detail-card">
    <div class="row g-0">
        <div class="col-md-6">
            @if($product->image_product)
                <img src="{{ asset('storage/' . $product->image_product) }}" alt="{{ $product->name_product }}" class="product-image">
            @else
                <div class="product-image" style="background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-image" style="font-size: 5rem; color: #999;"></i>
                </div>
            @endif
        </div>
        <div class="col-md-6 product-info">
            <h2 class="product-title">{{ $product->name_product }}</h2>
            
            <div class="product-price">
                Rp {{ number_format($product->price_product, 0, ',', '.') }}
            </div>

            <div class="info-label">Description</div>
            <div class="info-value">{{ $product->description_product }}</div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="info-label">Category</div>
                    <div class="info-value">{{ $product->category->category_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="info-label">Branch</div>
                    <div class="info-value">{{ $product->branch->name_branch }}</div>
                </div>
            </div>

            <div class="info-label">Stock Availability</div>
            <div class="mb-4">
                @if($product->stock_product > 10)
                    <span class="stock-badge stock-available">
                        <i class="bi bi-check-circle"></i> {{ $product->stock_product }} units available
                    </span>
                @elseif($product->stock_product > 0)
                    <span class="stock-badge stock-low">
                        <i class="bi bi-exclamation-circle"></i> Only {{ $product->stock_product }} units left
                    </span>
                @else
                    <span class="stock-badge stock-out">
                        <i class="bi bi-x-circle"></i> Out of stock
                    </span>
                @endif
            </div>

            <div class="d-flex gap-3">
                {{-- Add to Cart button (only for logged-in customers) --}}
                @auth
                    @if(auth()->user()->role === 'customer' && $product->stock_product > 0)
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-add-cart">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-add-cart" style="text-decoration: none;">
                        <i class="bi bi-box-arrow-in-right"></i> Login to Purchase
                    </a>
                @endauth

                <a href="/product" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection