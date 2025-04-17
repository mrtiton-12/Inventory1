@extends('layouts.admin')

@section('admin')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Admin</h3>
                        </div>

                       


                        <form action="{{route('adminprofile.update')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">

                                <div class="form-group">
                                  <label for="name">Name</label>
                                  <input type="text" class="form-control" name="name" id="name" value="{{$admin->name}}">
                                </div>
            
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{$admin->email}}">
                                  </div>
            
                                  <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control" name="username" id="username" value="{{$admin->username}}">
                                  </div>
            
                               
                                <div class="form-group">
                                    <label for="name">Profile Image</label>
                                    <input type="file" class="form-control" name="profile_image" id="profile_image">
                                    <img src="{{ asset($admin->profile_image) }}" width="100" class="mt-2">
                                </div>
            
                              </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-red">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                       

                        <form action="" method="POST">
                            @csrf
                            <div class="card-body">

                      
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control">
                            </div>
                    
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control">
                            </div>
                    
                            <div class="mb-3">
                                <label>Confirm New Password</label>
                                <input type="password" name="new_password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-danger">Change Password</button>
                            
                        </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
