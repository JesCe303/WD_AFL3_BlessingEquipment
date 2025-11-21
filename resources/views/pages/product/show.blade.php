@extends('layouts.master')

@section('content')
<style>


    /* Product Card - Tokopedia Style */
    .product-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transform: translateY(-5px);
    }

    /* Product Image */
    .product-image-container {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
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
        top: 10px;
        right: 10px;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }

    .stock-available {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }

    .stock-out {
        background: rgba(220, 53, 69, 0.9);
        color: white;
    }

    /* Product Info */
    .product-info {
        padding: 1rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-name {
        color: #1a2332;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 0.5rem;
        height: 2.5rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .product-price {
        color: #FFD700;
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .product-meta {
        margin-bottom: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .product-meta .badge {
        font-size: 0.75rem;
        font-weight: 500;
    }

    /* Action Buttons */
    .product-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: auto;
    }

    .btn-action-detail {
        flex: 1;
        background: linear-gradient(135deg, #1a2332 0%, #2a3545 100%);
        color: #FFD700;
        border: none;
        padding: 0.6rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
        text-decoration: none;
        text-align: center;
    }

    .btn-action-detail:hover {
        background: linear-gradient(135deg, #FFD700 0%, #FFC700 100%);
        color: #1a2332;
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
</style>

    <h1 style="color: #1a2332;">Our Products</h1>

    {{-- Display success message --}}
    @if(session('Message'))
        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
            <strong>Success!</strong> {{ session('Message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Shop branch info with dropdown to switch between branches (Surabaya/Jakarta) --}}
    {{-- Products are filtered by selected branch - each branch has different product codes --}}
    <hr>
    <div class="alert alert-custom">
        <div class="d-flex justify-content-between align-items-center">
            {{-- Display current branch details --}}
            <table style="border: none;">
                <tr>
                    <td style="border: none; padding: 2px 0;"><b>Shop Branch</b></td>
                    <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                    <td style="border: none; padding: 2px 0;">{{ $branch->name_branch }}</td>
                </tr>
                <tr>
                    <td style="border: none; padding: 2px 0;"><b>Address</b></td>
                    <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                    <td style="border: none; padding: 2px 0;">{{ $branch->address_branch }}</td>
                </tr>
                <tr>
                    <td style="border: none; padding: 2px 0;"><b>Type</b></td>
                    <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                    <td style="border: none; padding: 2px 0;">{{ $branch->type_branch }}</td>
                </tr>
            </table>
            {{-- Dropdown to switch branch - reloads page with ?branch=id parameter --}}
            <div class="dropdown">
                <button class="btn btn-add-branch dropdown-toggle" type="button" id="branchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-arrow-left-right me-1"></i>Change Branch
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="branchDropdown">
                    @foreach($branches as $b)
                        <li>
                            {{-- Active class highlights currently selected branch --}}
                            <a class="dropdown-item {{ $b->id_branch == $branch->id_branch ? 'active' : '' }}" 
                               href="/product?branch={{ $b->id_branch }}">
                                <i class="bi bi-building me-2"></i>{{ $b->name_branch }}
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
            <a href="/product/create?branch={{ $branch->id_branch }}" class="btn btn-add-product mb-3">
                <i class="bi bi-plus-circle me-1"></i>Add New Product
            </a>
        @endif
    @endauth

    {{-- Search bar - matches category and branch page style --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <span>Browse Products</span>
            <div style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Search product name..." onkeyup="filterProducts()">
            </div>
        </div>
    </div>

    {{-- Product Grid (Card Layout like Tokopedia) --}}
    <div id="productContainer" class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($data_product as $item)
            <div class="col">
                <div class="product-card">
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
                        <div class="product-actions">
                            {{-- Admin: Edit and Delete buttons --}}
                            @auth
                                @if(auth()->user()->role === 'admin')
                                    <button class="btn btn-sm btn-action-edit" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_product }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <a href="/product/{{ $item->id_product }}/edit" class="btn btn-sm btn-action-edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif
                            @endauth
                            
                            {{-- Everyone: View Details button --}}
                            <a href="/product/{{ $item->id_product }}" class="btn btn-action-detail">
                                <i class="bi bi-eye me-1"></i> View Details
                            </a>
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
        {{ $data_product->links() }}
    </div>

    <script>
        // Search function for card layout - updates product cards without page reload
        let searchTimeout;
        
        function filterProducts() {
            let searchInput = document.getElementById('searchInput');
            let keyword = searchInput.value;
            
            // Prevent sending multiple requests while user is still typing
            clearTimeout(searchTimeout);
            
            // Wait 500ms after user stops typing, then send request
            searchTimeout = setTimeout(function() {
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
                    updateProductCards(data.products);
                })
                .catch(error => console.error('Search error:', error));
            }, 500);
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
