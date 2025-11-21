@extends('layouts.master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            Add New Branch
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

            <form action="/branch" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="branchName" class="form-label form-label-custom">
                        <i class="bi bi-building me-1"></i>Branch Name
                    </label>
                    <input type="text" class="form-control" id="branchName" name="name_branch" 
                           placeholder="Enter branch name" required>
                </div>

                <div class="mb-3">
                    <label for="branchAddress" class="form-label form-label-custom">
                        <i class="bi bi-geo-alt me-1"></i>Branch Address
                    </label>
                    <textarea class="form-control" id="branchAddress" name="address_branch" 
                              rows="3" placeholder="Enter branch address..." required></textarea>
                </div>

                <div class="mb-3">
                    <label for="branchType" class="form-label form-label-custom">
                        <i class="bi bi-shop me-1"></i>Branch Type
                    </label>
                    <select class="form-control" id="branchType" name="type_branch" required>
                        <option value="">Select branch type</option>
                        <option value="Offline Store">Offline Store</option>
                        <option value="Online Store">Online Store</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="branchImage" class="form-label form-label-custom">
                        <i class="bi bi-image me-1"></i>Branch Image
                    </label>
                    <input type="file" class="form-control" id="branchImage" name="image_branch" 
                           accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                    <small class="text-muted">Max 2MB. Format: JPG, JPEG, PNG</small>
                    <div id="imagePreview" class="mt-2"></div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/branch" class="btn btn-cancel">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle me-1"></i>Add Branch
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Preview uploaded image
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
