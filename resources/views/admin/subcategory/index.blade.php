@extends('layouts.admin')

@section('admin')
    @include('layouts.message')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">SubCategory</h3>
                            <button style="float: right" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#subcategoryModal">
                                Add SubCategory
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category Name</th>
                                        <th>SubCategory Name</th>
                                        <th>SubCategory Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $key => $subcategory)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $subcategory->Category->category_name }}</td>
                                            <td>{{ $subcategory->subcategory_name }}</td>
                                            <td>{{ $subcategory->subcategory_slug }}</td>
                                            <td>


                                                <button class="editBtn btn btn-sm btn-primary"
                                                    data-name="{{ $subcategory->subcategory_name }}"
                                                    data-category-id="{{ $subcategory->category_id }}"
                                                    data-url="{{ route('subcategories.update', $subcategory->id) }}">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>


                                                <form action="{{route('subcategories.destroy',$subcategory->id)}}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal -->
    <div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('subcategories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoryModalLabel">Add New SubCategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">SubCategory Name</label>
                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">SubCategory Name</label>
                            <input type="text" class="form-control" id="subcategory_name" name="subcategory_name"
                                placeholder="Enter subcategory name" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Structure -->
    <div class="modal fade" id="editSubcategoryModal" tabindex="-1" role="dialog"
        aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editSubcategoryForm" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editSubcategoryName">Subcategory Name:</label>
                            <input type="text" class="form-control" id="editSubcategoryName" name="subcategory_name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="editCategoryId">Category:</label>
                            <select class="form-control" id="editCategoryId" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Subcategory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.editBtn');
            const editForm = document.getElementById('editSubcategoryForm');
            const subcategoryNameInput = document.getElementById('editSubcategoryName');
            const categoryIdInput = document.getElementById('editCategoryId');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const name = this.dataset.name;
                    const categoryId = this.dataset.categoryId;
                    const url = this.dataset.url;
                    editForm.action = url;
                    subcategoryNameInput.value = name;
                    categoryIdInput.value = categoryId;
                    $('#editSubcategoryModal').modal('show');
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastEl = document.getElementById('toastMessage');
            if (toastEl) {
                var toast = new bootstrap.Toast(toastEl);
                toast.show();
            }
        });
    </script>
@endsection
