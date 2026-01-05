@extends('layouts.master')

@section('content')

{{-- Page Header --}}
<div class="product-page-header">
    <div class="product-header-overlay">
        <div class="container">
            <h1 class="product-page-title">Our Products</h1>
            <p class="product-page-subtitle">Quality Spare Parts for Your Equipment</p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 3rem;">

<style>
    /* Product Page Header */
    .product-page-header {
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

    .product-page-header::before {
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

    .product-page-header::after {
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

    .product-header-overlay {
        position: relative;
        z-index: 1;
    }

    .product-page-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: #FFD700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
    }

    .product-page-subtitle {
        font-size: 1.3rem;
        opacity: 0.95;
        color: rgba(255, 255, 255, 0.9);
    }


    /* Product Card - Tokopedia Style */
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0,0,0,0.04);
        cursor: pointer;
        position: relative;
    }

    .product-card:hover {
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        transform: translateY(-8px);
        border-color: rgba(255, 215, 0, 0.2);
    }

    /* Product Image */
    .product-image-container {
        position: relative;
        width: 100%;
        height: 320px;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.08);
    }

    .product-no-image {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #999;
    }

    .product-no-image i {
        font-size: 4rem;
        margin-bottom: 0.5rem;
    }

    /* Stock Badge */
    .stock-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.8rem;
        font-weight: 700;
        backdrop-filter: blur(10px);
        letter-spacing: 0.3px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .stock-available {
        background: rgba(40, 167, 69, 0.95);
        color: white;
    }

    .stock-out {
        background: rgba(220, 53, 69, 0.95);
        color: white;
    }

    /* Favorite Button */
    .favorite-btn {
        position: absolute;
        top: 12px;
        left: 12px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.4s ease;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .favorite-btn:hover {
        transform: scale(1.15) rotate(10deg);
        background: white;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    .favorite-btn i {
        font-size: 1.3rem;
    }

    .favorite-btn.favorited i {
        color: #dc3545;
    }

    .favorite-btn:not(.favorited) i {
        color: #6c757d;
    }

    /* Product Info */
    .product-info {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .product-name {
        color: #1a2332;
        font-weight: 600;
        font-size: 1.05rem;
        line-height: 1.4;
        margin-bottom: 0;
        height: 2.8rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-price {
        color: #1a2332;
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 0;
        display: flex;
        align-items: baseline;
        gap: 0.3rem;
    }

    .product-price::before {
        content: 'Rp';
        font-size: 1rem;
        font-weight: 600;
        color: #6c757d;
    }

    .product-meta {
        margin-bottom: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .product-meta .badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
    }

    .badge-category {
        background: rgba(255, 215, 0, 0.15);
        color: #1a2332;
        border: 1px solid rgba(255, 215, 0, 0.3);
    }

    .badge-stock {
        background: rgba(23, 162, 184, 0.15);
        color: #117a8b;
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    /* Action Buttons */
    .product-actions {
        display: flex;
        gap: 0.6rem;
        margin-top: auto;
        padding-top: 0.5rem;
    }

    .btn-action-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .btn-action-icon:hover {
        background: #f8f9fa;
        border-color: #1a2332;
        transform: translateY(-2px);
    }

    .btn-action-icon i {
        font-size: 1.1rem;
        color: #1a2332;
    }

    .btn-action-detail {
        flex: 1;
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(26, 35, 50, 0.2);
    }

    .btn-action-detail:hover {
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #1a2332;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
    }

    .btn-action-cart {
        flex: 1;
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #1a2332;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        text-decoration: none;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }

    .btn-action-cart:hover {
        background: linear-gradient(135deg, #FFC700 0%, #FF8C00 100%);
        color: #1a2332;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
    }

    /* Modern Search & Filter Section */
    .search-filter-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.04);
    }

    .search-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }

    .search-icon {
        position: absolute;
        left: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.3rem;
        color: #6c757d;
        z-index: 1;
        pointer-events: none;
    }

    .search-input-modern {
        width: 100%;
        padding: 1.2rem 3.5rem 1.2rem 4.5rem;
        border: 2px solid #e9ecef;
        border-radius: 50px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
        color: #1a2332;
    }

    .search-input-modern:focus {
        outline: none;
        border-color: #FFD700;
        background: white;
        box-shadow: 0 0 0 4px rgba(255, 215, 0, 0.1);
    }

    .search-input-modern::placeholder {
        color: #adb5bd;
    }

    .search-clear-btn {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .search-clear-btn:hover {
        color: #dc3545;
        transform: translateY(-50%) scale(1.1);
    }

    .search-clear-btn i {
        font-size: 1.2rem;
    }

    .filter-info {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        color: #6c757d;
        font-size: 0.95rem;
        padding-left: 0.5rem;
    }

    .filter-info i {
        font-size: 1.1rem;
        color: #FFD700;
    }

    /* Add Product Button */
    .btn-add-product {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a2332;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

    .btn-add-product:hover {
        background: linear-gradient(135deg, #FFC700 0%, #FF8C00 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
        color: #1a2332;
    }
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    }

    .btn-action-edit {
        background: #6c757d;
        color: white;
        border: none;
        padding: 0.6rem 0.8rem;
        border-radius: 8px;
        transition: all 0.3s;
        text-decoration: none;
    }

    .btn-action-edit:hover {
        background: #5a6268;
        color: white;
    }

    /* Empty State */
    .empty-products {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .empty-products i {
        font-size: 5rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    /* Alert Custom */
    .alert-custom {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 2rem;
    }

    /* Branch Selector Card - Modern Design */
    .branch-selector-card {
        background: white;
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        transition: all 0.3s ease;
    }

    .branch-selector-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
    }

    .branch-info-section {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex: 1;
    }

    .branch-icon-wrapper {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    }

    .branch-icon-wrapper i {
        font-size: 2rem;
        color: #1a2332;
    }

    .branch-details {
        flex: 1;
    }

    .branch-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }

    .branch-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a2332;
        margin-bottom: 0.5rem;
    }

    .branch-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .branch-meta span {
        font-size: 0.95rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .branch-meta i {
        color: #FFD700;
        font-size: 1rem;
    }

    .branch-type-badge {
        padding: 0.3rem 0.9rem;
        background: rgba(255, 215, 0, 0.15);
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 20px;
        color: #1a2332;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .branch-action-section {
        flex-shrink: 0;
    }

    .btn-change-branch {
        background: linear-gradient(135deg, #1a2332 0%, #2c3e50 100%);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(26, 35, 50, 0.2);
    }

    .btn-change-branch:hover {
        background: linear-gradient(135deg, #2c3e50 0%, #1a2332 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 35, 50, 0.3);
        color: white;
    }

    .btn-change-branch i:first-child {
        font-size: 1.1rem;
    }

    /* Dropdown Menu Modern */
    .dropdown-menu-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        min-width: 300px;
        margin-top: 0.5rem;
    }

    .dropdown-item-modern {
        border-radius: 12px;
        padding: 0;
        margin-bottom: 0.3rem;
        border: none;
        transition: all 0.3s ease;
    }

    .dropdown-item-modern:last-child {
        margin-bottom: 0;
    }

    .dropdown-item-content {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.2rem;
    }

    .dropdown-item-content > i:first-child {
        font-size: 1.5rem;
        color: #6c757d;
        flex-shrink: 0;
    }

    .dropdown-item-text {
        flex: 1;
    }

    .dropdown-item-title {
        font-weight: 600;
        color: #1a2332;
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }

    .dropdown-item-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .dropdown-item-check {
        color: #28a745;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .dropdown-item-modern:hover {
        background: rgba(255, 215, 0, 0.1);
    }

    .dropdown-item-modern.active {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.15) 0%, rgba(255, 165, 0, 0.1) 100%);
    }

    .dropdown-item-modern.active .dropdown-item-content > i:first-child,
    .dropdown-item-modern.active .dropdown-item-title {
        color: #1a2332;
    }

    .btn-add-branch {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        color: #1a2332;
        font-weight: 600;
        padding: 0.7rem 1.5rem;
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }

    .btn-add-branch:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.4);
        color: #1a2332;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .product-page-title {
            font-size: 2.5rem;
        }

        .product-page-subtitle {
            font-size: 1.1rem;
        }

        .branch-selector-card {
            flex-direction: column;
            align-items: flex-start;
            padding: 1.5rem;
        }

        .branch-info-section {
            width: 100%;
        }

        .branch-action-section {
            width: 100%;
        }

        .btn-change-branch {
            width: 100%;
            justify-content: center;
        }

        .dropdown-menu-modern {
            min-width: 100%;
        }
    }
</style>

    {{-- Display success message --}}
    @if(session('Message'))
        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
            <strong>Success!</strong> {{ session('Message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Branch Selector Card - Modern Design --}}
    <div class="branch-selector-card">
        <div class="branch-info-section">
            <div class="branch-icon-wrapper">
                <i class="bi bi-building"></i>
            </div>
            <div class="branch-details">
                <div class="branch-label">Current Location</div>
                <div class="branch-name">{{ $branch->name_branch }}</div>
                <div class="branch-meta">
                    <span><i class="bi bi-geo-alt-fill"></i> {{ $branch->address_branch }}</span>
                    <span class="branch-type-badge">{{ $branch->type_branch }}</span>
                </div>
            </div>
        </div>
        <div class="branch-action-section">
            <div class="dropdown">
                <button class="btn-change-branch dropdown-toggle" type="button" id="branchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Switch Location</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-modern" aria-labelledby="branchDropdown">
                    @foreach($branches as $b)
                        <li>
                            <a class="dropdown-item-modern {{ $b->id_branch == $branch->id_branch ? 'active' : '' }}" 
                               href="/product?branch={{ $b->id_branch }}">
                                <div class="dropdown-item-content">
                                    <i class="bi bi-building-check"></i>
                                    <div class="dropdown-item-text">
                                        <div class="dropdown-item-title">{{ $b->name_branch }}</div>
                                        <div class="dropdown-item-subtitle">{{ $b->type_branch }}</div>
                                    </div>
                                    @if($b->id_branch == $branch->id_branch)
                                        <i class="bi bi-check-circle-fill dropdown-item-check"></i>
                                    @endif
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Add product button - Only visible for admin users --}}
    @auth
        @if(auth()->user()->role === 'admin')
            <a href="/product/create?branch={{ $branch->id_branch }}" class="btn btn-add-product mb-4">
                <i class="bi bi-plus-circle me-2"></i>Add New Product
            </a>
        @endif
    @endauth

    {{-- Modern Search & Filter Section --}}
    <div class="search-filter-section">
        <div class="search-wrapper">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input-modern" placeholder="Search products by name..." onkeyup="filterProducts()">
            <button class="search-clear-btn" onclick="clearSearch()" style="display: none;">
                <i class="bi bi-x-circle-fill"></i>
            </button>
        </div>
        <div class="filter-info">
            <i class="bi bi-funnel"></i>
            <span id="productCount">Showing all products</span>
        </div>
    </div>

    {{-- Product Grid (Card Layout like Tokopedia) --}}
    <div id="productContainer" class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($data_product as $item)
            <div class="col">
                <div class="product-card" onclick="window.location.href='/product/{{ $item->id_product }}'">
                    {{-- Product Image --}}
                    <div class="product-image-container">
                        @if($item->image_product)
                            <img src="{{ asset('storage/' . $item->image_product) }}" alt="{{ $item->name_product }}" class="product-image">
                        @else
                            <div class="product-no-image">
                                <i class="bi bi-image"></i>
                                <p>No Image</p>
                            </div>
                        @endif
                        
                        {{-- Favorite Button (Customer only) --}}
                        @auth
                            @if(auth()->user()->role === 'customer')
                                @php
                                    $isFavorited = \App\Models\Favorite::where('id_user', auth()->id())
                                        ->where('id_product', $item->id_product)
                                        ->exists();
                                @endphp
                                <form action="{{ route('favorite.toggle') }}" method="POST" style="display: inline;" onclick="event.stopPropagation();">
                                    @csrf
                                    <input type="hidden" name="id_product" value="{{ $item->id_product }}">
                                    <button type="submit" class="favorite-btn {{ $isFavorited ? 'favorited' : '' }}">
                                        <i class="bi bi-heart{{ $isFavorited ? '-fill' : '' }}"></i>
                                    </button>
                                </form>
                            @endif
                        @endauth
                        
                        {{-- Stock Badge --}}
                        @if($item->stock_product > 0)
                            <span class="stock-badge stock-available">
                                <i class="bi bi-check-circle"></i> In Stock
                            </span>
                        @else
                            <span class="stock-badge stock-out">
                                <i class="bi bi-x-circle"></i> Out of Stock
                            </span>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="product-info">
                        <h6 class="product-name">{{ $item->name_product }}</h6>
                        
                        <div class="product-price">
                            Rp {{ number_format($item->price_product, 0, ',', '.') }}
                        </div>

                        <div class="product-meta">
                            <span class="badge bg-secondary me-1">
                                <i class="bi bi-tag"></i> {{ $item->category_name }}
                            </span>
                            <span class="badge bg-info">
                                <i class="bi bi-geo-alt"></i> Stock: {{ $item->stock_product }}
                            </span>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="product-actions" onclick="event.stopPropagation();">
                            {{-- Admin: Edit and Delete buttons --}}
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <button class="btn btn-sm btn-action-edit" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_product }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <a href="/product/{{ $item->id_product }}/edit" class="btn btn-sm btn-action-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @else
                                    {{-- Customer: Add to Cart button --}}
                                    <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                                        @csrf
                                        <input type="hidden" name="id_product" value="{{ $item->id_product }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-action-cart" {{ $item->stock_product <= 0 ? 'disabled' : '' }}>
                                            <i class="bi bi-cart-plus"></i> Add to Cart
                                        </button>
                                    </form>
                                @endif
                            @else
                                {{-- Guest: Add to Cart button --}}
                                <form action="{{ route('cart.add') }}" method="POST" style="flex: 1;">
                                    @csrf
                                    <input type="hidden" name="id_product" value="{{ $item->id_product }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-action-cart" {{ $item->stock_product <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus"></i> Add to Cart
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delete Confirmation Modal --}}
            <div class="modal fade" id="deleteModal{{ $item->id_product }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id_product }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id_product }}">
                                <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-0"><strong>Are you sure you want to delete this product?</strong></p>
                            <p class="mt-2 mb-0">Product: <strong>{{ $item->name_product }}</strong></p>
                            <p class="text-muted small mt-2">This action cannot be undone.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-cancel-modal" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>Cancel
                            </button>
                            <form action="/product/{{ $item->id_product }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-confirm-delete">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $data_product->links('pagination::bootstrap-5') }}
    </div>

    <script>
        // Search function for card layout - updates product cards without page reload
        let searchTimeout;
        
        function filterProducts() {
            let searchInput = document.getElementById('searchInput');
            let keyword = searchInput.value;
            let clearBtn = document.querySelector('.search-clear-btn');
            let productCount = document.getElementById('productCount');
            
            // Show/hide clear button
            if (keyword.length > 0) {
                clearBtn.style.display = 'flex';
            } else {
                clearBtn.style.display = 'none';
            }
            
            // Prevent sending multiple requests while user is still typing
            clearTimeout(searchTimeout);
            
            // Wait 500ms after user stops typing, then send request
            searchTimeout = setTimeout(function() {
                if (keyword.trim() === '') {
                    productCount.textContent = 'Showing all products';
                    return;
                }
                
                productCount.innerHTML = '<i class="spinner-border spinner-border-sm me-2"></i>Searching...';
                
                // Send AJAX request to /product?search=keyword
                fetch('/product?search=' + encodeURIComponent(keyword), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // data.products is paginated object with 'data' property containing actual products
                    let count = data.products.data.length;
                    productCount.textContent = `Found ${count} product${count !== 1 ? 's' : ''}`;
                    updateProductCards(data.products.data);
                })
                .catch(error => {
                    console.error('Search error:', error);
                    productCount.textContent = 'Search error occurred';
                });
            }, 500);
        }
        
        function clearSearch() {
            let searchInput = document.getElementById('searchInput');
            searchInput.value = '';
            document.querySelector('.search-clear-btn').style.display = 'none';
            document.getElementById('productCount').textContent = 'Showing all products';
            location.reload(); // Reload to show all products
        }
        
        function updateProductCards(products) {
            let container = document.getElementById('productContainer');
            
            // If no search keyword, don't update (keep original products)
            let searchInput = document.getElementById('searchInput');
            if (searchInput.value.trim() === '') {
                return;
            }
            
            container.innerHTML = '';
            
            if (products.length === 0) {
                container.innerHTML = `
                    <div class="col-12">
                        <div class="empty-products">
                            <i class="bi bi-search"></i>
                            <h4>No products found</h4>
                            <p class="text-muted">Try searching with different keywords</p>
                        </div>
                    </div>
                `;
                return;
            }
            
            // Check if user is admin to show Edit/Delete buttons
            let isAdmin = {{ auth()->check() && auth()->user()->role === 'admin' ? 'true' : 'false' }};
            
            products.forEach((product) => {
                let imageHtml = product.image_product 
                    ? `<img src="/storage/${product.image_product}" alt="${product.name_product}" class="product-image">`
                    : `<div class="product-no-image">
                           <i class="bi bi-image"></i>
                           <p>No Image</p>
                       </div>`;
                
                let stockBadge = product.stock_product > 0
                    ? '<span class="stock-badge stock-available"><i class="bi bi-check-circle"></i> In Stock</span>'
                    : '<span class="stock-badge stock-out"><i class="bi bi-x-circle"></i> Out of Stock</span>';
                
                let adminButtons = isAdmin 
                    ? `<button class="btn btn-sm btn-action-edit" data-bs-toggle="modal" data-bs-target="#deleteModal${product.id_product}">
                           <i class="bi bi-trash"></i>
                       </button>
                       <a href="/product/${product.id_product}/edit" class="btn btn-sm btn-action-edit">
                           <i class="bi bi-pencil"></i>
                       </a>`
                    : '';
                
                let card = `
                    <div class="col">
                        <div class="product-card">
                            <div class="product-image-container">
                                ${imageHtml}
                                ${stockBadge}
                            </div>
                            <div class="product-info">
                                <h6 class="product-name">${product.name_product}</h6>
                                <div class="product-price">Rp ${formatPrice(product.price_product)}</div>
                                <div class="product-meta">
                                    <span class="badge bg-secondary me-1">
                                        <i class="bi bi-tag"></i> ${product.category_name}
                                    </span>
                                    <span class="badge bg-info">
                                        <i class="bi bi-geo-alt"></i> Stock: ${product.stock_product}
                                    </span>
                                </div>
                                <div class="product-actions">
                                    ${adminButtons}
                                    <a href="/product/${product.id_product}" class="btn btn-action-detail">
                                        <i class="bi bi-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        }
        
        // Convert number to Indonesian price format with dots
        function formatPrice(price) {
            return parseInt(price).toLocaleString('id-ID');
        }
    </script>
@endsection
