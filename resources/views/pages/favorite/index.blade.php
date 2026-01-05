@extends('layouts.master')

@section('content')

{{-- Page Header --}}
<div class="page-header-modern">
    <div class="page-header-overlay">
        <div class="container">
            <h1 class="page-header-title"><i class="bi bi-heart-fill me-3"></i>My Favorites</h1>
            <p class="page-header-subtitle">Your saved products collection</p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 3rem;">

{{-- Flash Messages --}}
@if(session('Message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 0 0 2rem 0; background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 8px;">
        {{ session('Message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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

    .favorite-header {
        display: none;
    }

    .favorite-card {
        background: white;
        border: 2px solid #1a2332;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        height: 100%;
    }

    .favorite-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .favorite-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
    }

    .favorite-card-body {
        padding: 1.5rem;
    }

    .btn-view {
        background-color: #1a2332;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        text-align: center;
    }

    .btn-view:hover {
        background-color: #FFD700;
        color: #1a2332;
    }

    .btn-unfavorite {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
        margin-top: 0.5rem;
        width: 100%;
    }

    .btn-unfavorite:hover {
        background-color: #c82333;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 15px;
        border: 2px solid #e0e0e0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .empty-state-icon {
        width: 150px;
        height: 150px;
        margin: 0 auto 2rem;
        background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state-icon i {
        font-size: 4rem;
        color: #bbb;
    }

    .empty-state h3 {
        color: #1a2332;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    .btn-browse {
        background: linear-gradient(135deg, #1a2332 0%, #2a3545 100%);
        color: #FFD700;
        padding: 1rem 2.5rem;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s;
        border: 2px solid transparent;
        box-shadow: 0 4px 15px rgba(26, 35, 50, 0.3);
    }

    .btn-browse:hover {
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #1a2332;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        border-color: #1a2332;
    }

    .btn-browse i {
        margin-right: 0.5rem;
    }

    .product-price {
        font-size: 1.3rem;
        color: #FFD700;
        font-weight: 700;
        margin: 0.5rem 0;
    }

    .product-stock {
        font-size: 0.9rem;
        color: #6c757d;
    }
</style>

<div class="container" style="max-width: 1200px; margin-top: 2rem;">
    <div class="favorite-header">
        <h1><i class="bi bi-heart-fill"></i> My Favorites</h1>
        <p style="margin: 0.5rem 0 0 0; opacity: 0.9;">Products you love</p>
    </div>

    <div class="bg-white" style="padding: 2rem; border-radius: 10px; border: 2px solid #1a2332;">
        @if($favorites->isEmpty())
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-heart"></i>
                </div>
                <h3>No Favorites Yet</h3>
                <p>Start adding products to your favorites!</p>
                <a href="{{ route('product.index') }}" class="btn-browse">
                    <i class="bi bi-search"></i> Browse Products
                </a>
            </div>
        @else
            <div class="row">
                @foreach($favorites as $favorite)
                    <div class="col-md-4 mb-4">
                        <div class="favorite-card">
                            @if($favorite->product->image_product)
                                <img src="{{ asset('storage/' . $favorite->product->image_product) }}" 
                                     alt="{{ $favorite->product->name_product }}">
                            @else
                                <div style="width: 100%; height: 250px; background: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-image" style="font-size: 4rem; color: #ccc;"></i>
                                </div>
                            @endif
                            
                            <div class="favorite-card-body">
                                <h5 style="color: #1a2332; font-weight: 700; margin-bottom: 0.5rem;">{{ $favorite->product->name_product }}</h5>
                                
                                <p class="product-price">
                                    Rp {{ number_format($favorite->product->price_product, 0, ',', '.') }}
                                </p>
                                
                                <p class="product-stock">
                                    <i class="bi bi-box-seam"></i> Stock: {{ $favorite->product->stock_product }}
                                </p>
                                
                                <p style="font-size: 0.85rem; color: #6c757d; margin-top: 0.5rem;">
                                    <i class="bi bi-tag"></i> {{ $favorite->product->category->category_name }}<br>
                                    <i class="bi bi-shop"></i> {{ $favorite->product->branch->name_branch }}
                                </p>
                                
                                <a href="{{ route('product.show', $favorite->product->id_product) }}" class="btn-view">
                                    <i class="bi bi-eye"></i> View Details
                                </a>
                                
                                <form action="{{ route('favorite.destroy', $favorite->id_favorite) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Remove from favorites?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-unfavorite">
                                        <i class="bi bi-heart-fill"></i> Remove from Favorites
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
