@extends('layouts.master')

@section('content')
    <h1 style="color: #1a2332;">Category Management</h1>

    {{-- Display success message --}}
    @if(session('Message'))
        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
            <strong>Success!</strong> {{ session('Message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Button for adding new category --}}
    <a href="/category/create" class="btn btn-add-category mb-3">
        <i class="bi bi-plus-circle me-1"></i>Add New Category
    </a>

    {{-- Category list with search --}}
    <div class="card shadow-sm">
        <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <span>Category List</span>
            <div style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Search category..." onkeyup="filterTable()">
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_category as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->category_description }}</td>
                            <td>
                                <a href="/category/{{ $item->id_category }}/edit" class="btn btn-sm btn-edit">Edit</a>
                                {{-- Disable delete for Uncategorized - default category protection --}}
                                @if($item->category_name !== 'Uncategorized')
                                    <button class="btn btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_category }}">Delete</button>
                                @else
                                    {{-- Grayed out button for default category (same as Surabaya branch) --}}
                                    <button class="btn btn-sm btn-secondary" disabled title="Default category cannot be deleted">Delete</button>
                                @endif
                            </td>
                        </tr>

                        {{-- Delete Confirmation Modal --}}
                        <div class="modal fade" id="deleteModal{{ $item->id_category }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id_category }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-header-custom">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id_category }}">
                                            <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0"><strong>Are you sure you want to delete this category?</strong></p>
                                        <p class="mt-2 mb-0">Category: <strong>{{ $item->category_name }}</strong></p>
                                        <p class="text-muted small mt-2">This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-cancel-modal" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i>Cancel
                                        </button>
                                        <form action="/category/{{ $item->id_category }}" method="POST" style="display: inline;">
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
            <div class="d-flex justify-content-center mt-3">
                {{ $data_category->links() }}
            </div>
        </div>
    </div>

    <script>
        // Search function that sends keyword to controller and updates table without page reload
        let searchTimeout;
        
        function filterTable() {
            let searchInput = document.getElementById('searchInput');
            let keyword = searchInput.value;
            
            // Prevent sending multiple requests while user is still typing
            clearTimeout(searchTimeout);
            
            // Wait 500ms after user stops typing, then send request
            searchTimeout = setTimeout(function() {
                // Send AJAX request to /category?search=keyword
                fetch('/category?search=' + encodeURIComponent(keyword), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTable(data.categories);
                })
                .catch(error => console.error('Search error:', error));
            }, 500);
        }
        
        // Rebuild table rows with filtered categories from controller
        function updateTable(categories) {
            let tbody = document.querySelector('.table tbody');
            tbody.innerHTML = '';
            
            // Show "no results" message if empty
            if (categories.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center">No categories found</td></tr>';
                return;
            }
            
            // Generate table rows from category data (AJAX search results)
            categories.forEach((category, index) => {
                // Disable delete button for Uncategorized default category
                let deleteButton = category.category_name === 'Uncategorized'
                    ? '<button class="btn btn-sm btn-secondary" disabled title="Default category cannot be deleted">Delete</button>'
                    : `<button class="btn btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal${category.id_category}">Delete</button>`;
                
                let row = `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${category.category_name}</td>
                        <td>${category.category_description}</td>
                        <td>
                            <a href="/category/${category.id_category}/edit" class="btn btn-sm btn-edit">Edit</a>
                            ${deleteButton}
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }
    </script>
@endsection
