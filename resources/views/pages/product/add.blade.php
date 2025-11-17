@extends('layouts.master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            Add New Product
        </div>

        <div class="card-body p-4">
            <form action="/product" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="productName" class="form-label form-label-custom">
                            <i class="bi bi-box-seam me-1"></i>Product Name
                        </label>
                        {{-- CLIENT-SIDE VALIDATIION --}}
                        {{-- required attribute triggers browser validation with "Please fill out this field" message --}}
                        <input type="text" class="form-control" id="productName" name="name_product" 
                               placeholder="Enter product name" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="productPrice" class="form-label form-label-custom">
                            <i class="bi bi-tag me-1"></i>Price (Rp)
                        </label>
                        {{-- required attribute triggers browser validation with "Please fill out this field" message --}}
                        <input type="text" class="form-control" id="productPrice" name="price_product" 
                               placeholder="0" required oninput="formatPrice(this)">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label form-label-custom">
                        <i class="bi bi-card-text me-1"></i>Product Description
                    </label>
                    {{-- required attribute triggers browser validation with "Please fill out this field" message --}}
                    <textarea class="form-control" id="productDescription" name="description_product" 
                              rows="5" placeholder="Enter detailed product description..." required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/product" class="btn btn-cancel">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle me-1"></i>Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function formatPrice(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');
            
            // Add dots every 3 digits from right
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            
            input.value = value;
        }
    </script>
@endsection
