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
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category</h3>
                            <button style="float: right" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">
                                Add Employe
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Employe Name</th>
                                        <th>Employe Designation</th>
                                        <th>Employe Phone</th>
                                        <th>Employe Email</th>
                                        <th>Employe Experience</th>
                                        <th>Employe Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employes as $key => $employee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $employee->employe_name }}</td>
                                            <td>{{ $employee->employe_designation }}</td>
                                            <td>{{ $employee->employe_phone }}</td>
                                            <td>{{ $employee->employe_email }}</td>
                                            <td>{{ $employee->experience }}</td>
                                            <td> <img src="/images/{{ $employee->employe_image }}" height="100px"></td>
                                            <td>

                                                <button class="btn btn-sm btn-primary editEmployeeBtn"
                                                data-id="{{ $employee->id }}"
                                                data-name="{{ $employee->employe_name }}"
                                                data-phone="{{ $employee->employe_phone }}"
                                                data-email="{{ $employee->employe_email }}"
                                                data-experience="{{ $employee->experience }}"
                                                data-designation="{{ $employee->employe_designation }}"
                                                data-image="/images/{{$employee->image}}"
                                                data-url="{{route('employes.update',$employee->id)}}"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editEmployeeModal">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>


                                                <form action="{{route('employes.destroy',$employee->id)}}" method="POST" style="display: inline;">
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>



    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel">Add New Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="employe_name" class="form-label">Employee Name</label>
                            <input type="text" class="form-control" id="employe_name" name="employe_name"
                                placeholder="Enter employee name" required>
                        </div>

                        <div class="mb-3">
                            <label for="employe_designation" class="form-label">Employee Designation</label>
                            <input type="text" class="form-control" id="employe_designation" name="employe_designation"
                                placeholder="Enter employee Designation" required>
                        </div>

                        <div class="mb-3">
                            <label for="employe_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="employe_phone" name="employe_phone"
                                placeholder="Enter phone number" required>
                        </div>

                        <div class="mb-3">
                            <label for="employe_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="employe_email" name="employe_email"
                                placeholder="Enter email address" required>
                        </div>

                        <div class="mb-3">
                            <label for="experience" class="form-label">Experience</label>
                            <input type="text" class="form-control" id="experience" name="experience"
                                placeholder="e.g. 2 years, 5 years">
                        </div>

                        <div class="mb-3">
                            <label for="employe_image" class="form-label">Employee Image</label>
                            <input type="file" class="form-control" id="employe_image" name="employe_image"
                                accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save Employee</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editEmployeeForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editEmployeeId">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="employe_name" id="editEmployeName" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="employe_phone" id="editEmployePhone" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="employe_email" id="editEmployeEmail" class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Experience</label>
                            <input type="text" name="experience" id="editExperience" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input type="text" name="employe_designation" id="editDesignation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="employe_image" class="form-control">
                            <img id="editImagePreview" src="" alt="Employee Image" class="mt-2"
                                width="80">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
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
      document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editEmployeeBtn');
    const editForm = document.getElementById('editEmployeeForm');
    const imagePreview = document.getElementById('editImagePreview');
    const imageInput = document.getElementById('editEmployeImageInput');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const url = this.dataset.url;
            document.getElementById('editEmployeName').value = this.dataset.name;
            document.getElementById('editEmployePhone').value = this.dataset.phone;
            document.getElementById('editEmployeEmail').value = this.dataset.email;
            document.getElementById('editExperience').value = this.dataset.experience;
            document.getElementById('editDesignation').value = this.dataset.designation;

        
            const imagePath = this.dataset.image;
            imagePreview.src = imagePath; 
            imagePreview.style.display = 'block'; 

            editForm.action = url;
        });
    });

    imageInput.addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]); 
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
