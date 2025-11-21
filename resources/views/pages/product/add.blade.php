@extends('layouts.master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            Add New Product
        </div>

        <div class="card-body p-4">
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

            {{-- Hidden input to pass current branch from URL --}}
            <form action="/product" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_branch" value="{{ $branch->id_branch }}">
                
                {{-- Show current branch info (read-only) --}}
                <div class="alert alert-info mb-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Branch:</strong> {{ $branch->name_branch }} - 
                    <small>This product will be added to this branch</small>
                </div>

                <div class="mb-3">
                    <label for="productName" class="form-label form-label-custom">
                        <i class="bi bi-box-seam me-1"></i>Product Name
                    </label>
                    <input type="text" class="form-control" id="productName" name="name_product" 
                           placeholder="Enter product name" required>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="productPrice" class="form-label form-label-custom">
                            <i class="bi bi-tag me-1"></i>Price (Rp)
                        </label>
                        <input type="text" class="form-control" id="productPrice" name="price_product" 
                               placeholder="0" required oninput="formatPrice(this)">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="productStock" class="form-label form-label-custom">
                            <i class="bi bi-boxes me-1"></i>Stock
                        </label>
                        <input type="number" class="form-control" id="productStock" name="stock_product" 
                               placeholder="0" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="productCategory" class="form-label form-label-custom">
                        <i class="bi bi-folder me-1"></i>Category
                    </label>
                    <select class="form-control" id="productCategory" name="id_category" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_category }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label form-label-custom">
                        <i class="bi bi-card-text me-1"></i>Product Description
                    </label>
                    <textarea class="form-control" id="productDescription" name="description_product" 
                              rows="4" placeholder="Enter detailed product description..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label form-label-custom">
                        <i class="bi bi-image me-1"></i>Product Image
                    </label>
                    <input type="file" class="form-control" id="productImage" name="image_product" 
                           accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                    <small class="text-muted">Max 2MB. Format: JPG, JPEG, PNG</small>
                    <div id="imagePreview" class="mt-2"></div>
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
            let value = input.value.replace(/\D/g, '');
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            input.value = value;
        }

        function previewImage(input) {
            let preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = '<img src="' + e.target.result + '" class="img-preview" alt="Preview">';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection
