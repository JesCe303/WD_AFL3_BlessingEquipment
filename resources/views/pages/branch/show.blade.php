@extends('layouts.master')

@section('content')

{{-- Page Header --}}
<div class="page-header-modern">
    <div class="page-header-overlay">
        <div class="container">
            <h1 class="page-header-title"><i class="bi bi-building me-3"></i>Branch Management</h1>
            <p class="page-header-subtitle">Manage your store locations</p>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 3rem; margin-bottom: 3rem;">

<style>
    /* Page Header Modern */
    .page-header-modern {
        background: linear-gradient(135deg, rgba(26, 35, 50, 0.95) 0%, rgba(44, 62, 80, 0.92) 100%),
                    url('https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069') center/cover;
        padding: 140px 0 100px;
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
</style>

    {{-- Display success message --}}
    @if(session('Message'))
        <div class="alert alert-dismissible fade show" role="alert" style="background-color: #FFD700; border: 2px solid #1a2332; color: #1a2332;">
            <strong>Success!</strong> {{ session('Message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Display error message --}}
    @if(session('Error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('Error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Button for adding new branch --}}
    <a href="/branch/create" class="btn btn-add-branch mb-3">
        <i class="bi bi-plus-circle me-1"></i>Add New Branch
    </a>

    {{-- Branch list with search --}}
    <div class="card shadow-sm">
        <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
            <span>Branch List</span>
            <div style="width: 300px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Search branch..." onkeyup="filterTable()">
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Branch Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Type</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_branch as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                @if($item->image_branch)
                                    <img src="{{ asset('storage/' . $item->image_branch) }}" alt="Branch Image" class="img-thumbnail-list">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->name_branch }}</td>
                            <td>{{ $item->address_branch }}</td>
                            <td>{{ $item->type_branch }}</td>
                            <td>


                                {{-- cannot delete main branch --}}
                                <a href="/branch/{{ $item->id_branch }}/edit" class="btn btn-sm btn-edit">Edit</a>
                                @if($item->name_branch !== 'Blessing Equipment Surabaya')
                                    <button class="btn btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id_branch }}">Delete</button>
                                @else
                                    <button class="btn btn-sm btn-delete" disabled title="Main branch cannot be deleted">Delete</button>
                                @endif
                            </td>
                        </tr>

                        {{-- Delete Confirmation Modal --}}
                        <div class="modal fade" id="deleteModal{{ $item->id_branch }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id_branch }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-header-custom">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id_branch }}">
                                            <i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0"><strong>Are you sure you want to delete this branch?</strong></p>
                                        <p class="mt-2 mb-0">Branch: <strong>{{ $item->name_branch }}</strong></p>
                                        <p class="text-muted small mt-2">This action cannot be undone.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-cancel-modal" data-bs-dismiss="modal">
                                            <i class="bi bi-x-circle me-1"></i>Cancel
                                        </button>
                                        <form action="/branch/{{ $item->id_branch }}" method="POST" style="display: inline;">
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
                {{ $data_branch->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        // Search function for real-time filtering
        let searchTimeout;
        
        function filterTable() {
            let searchInput = document.getElementById('searchInput');
            let keyword = searchInput.value;
            
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(function() {
                fetch('/branch?search=' + encodeURIComponent(keyword), {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    updateTable(data.branches);
                })
                .catch(error => console.error('Search error:', error));
            }, 500);
        }
        
        // Update table with search results
        function updateTable(branches) {
            let tbody = document.querySelector('.table tbody');
            tbody.innerHTML = '';
            
            if (branches.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No branches found</td></tr>';
                return;
            }
            
            branches.forEach((branch, index) => {
                let imageHtml = branch.image_branch 
                    ? `<img src="/storage/${branch.image_branch}" alt="Branch Image" class="img-thumbnail-list">`
                    : '<span class="text-muted">No Image</span>';
                    
                let deleteBtn = branch.name_branch !== 'Blessing Equipment Surabaya'
                    ? `<button class="btn btn-sm btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal${branch.id_branch}">Delete</button>`
                    : `<button class="btn btn-sm btn-delete" disabled title="Main branch cannot be deleted">Delete</button>`;
                
                let row = `
                    <tr>
                        <th scope="row">${index + 1}</th>
                        <td>${imageHtml}</td>
                        <td>${branch.name_branch}</td>
                        <td>${branch.address_branch}</td>
                        <td>${branch.type_branch}</td>
                        <td>
                            <a href="/branch/${branch.id_branch}/edit" class="btn btn-sm btn-edit">Edit</a>
                            ${deleteBtn}
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }
    </script>
@endsection