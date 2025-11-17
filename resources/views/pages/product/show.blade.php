@extends('layouts.master')

@section('content')
    <h1 style="color: #1a2332;">Our Products</h1>

    {{-- Display success message --}}
    @if(session('Message'))
        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
            <strong>Success!</strong> {{ session('Message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Shop branch information --}}
    <hr>
    <div class="alert alert-custom">
        <table style="border: none;">
            <tr>
                <td style="border: none; padding: 2px 0;"><b>Shop Branch</b></td>
                <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                <td style="border: none; padding: 2px 0;">{{ $data_shop['shop_branch'] }}</td>
            </tr>
            <tr>
                <td style="border: none; padding: 2px 0;"><b>Address</b></td>
                <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                <td style="border: none; padding: 2px 0;">{{ $data_shop['address'] }}</td>
            </tr>
            <tr>
                <td style="border: none; padding: 2px 0;"><b>Type</b></td>
                <td style="border: none; padding: 2px 10px;"><b>:</b></td>
                <td style="border: none; padding: 2px 0;">{{ $data_shop['type'] }}</td>
            </tr>
        </table>
    </div>

    {{-- button for adding new product --}}
    <a href="/product/create" class="btn btn-add-product mb-3">
        <i class="bi bi-plus-circle me-1"></i>Add New Product
    </a>

    <div class="card shadow-sm">
        <div class="card-header card-header-custom">
            Product List
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_product as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->name_product }}</td>
                            {{-- add . for every 000 --}}
                            <td>{{ number_format($item->price_product, 0, ',', '.') }}</td>
                            <td>{{ $item->description_product }}</td>
                            <td>
                                <button class="btn btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_product }}" data-product-name="{{ $item->name_product }}">Delete</button>
                                <a href="/product/{{ $item->id_product }}/edit" class="btn btn-sm btn-edit">Edit</a>
                                <a href="/product/{{ $item->id_product }}" class="btn btn-sm btn-detail">Detail</a>
                            </td>
                        </tr>

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
                </tbody>
            </table>
        </div>
    </div>
@endsection
