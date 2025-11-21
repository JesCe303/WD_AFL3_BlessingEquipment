@extends('layouts.master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            Edit Category
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

            <form action="/category/{{ $data->id_category }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="categoryName" class="form-label form-label-custom">
                        <i class="bi bi-folder me-1"></i>Category Name
                    </label>
                    <input type="text" class="form-control" id="categoryName" name="category_name" 
                           value="{{ $data->category_name }}" placeholder="Enter category name" required>
                </div>

                <div class="mb-3">
                    <label for="categoryDescription" class="form-label form-label-custom">
                        <i class="bi bi-card-text me-1"></i>Category Description
                    </label>
                    <textarea class="form-control" id="categoryDescription" name="category_description" 
                              rows="4" placeholder="Enter category description..." required>{{ $data->category_description }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="/category" class="btn btn-cancel">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-submit">
                        <i class="bi bi-check-circle me-1"></i>Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
