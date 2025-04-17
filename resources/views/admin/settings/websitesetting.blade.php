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

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Update Setting</h3>
                        </div>


                        <form action="{{route('website.update',$websitesetting->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">

                                <div class="row">
                                    <!-- Column 1 -->
                                    <div class="col-md-6">
                                     

                                        <div class="form-group">
                                            <label for="website_name">Website Name</label>
                                            <input type="text" name="website_name" id="website_name" class="form-control"
                                                value="{{ old('website_name', $websitesetting->website_name) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="website_phone">Website Phone</label>
                                            <input type="text" name="website_phone" id="website_phone"
                                                class="form-control"
                                                value="{{ old('website_phone', $websitesetting->website_phone) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ old('address', $websitesetting->website_address) }}">
                                        </div>

                                        <div class="form-group">
                                            <select name="currency" id="currency" class="form-control">
                                                <option value="$" {{ old('currency', $websitesetting->currency) == '$' ? 'selected' : '' }}>$</option>
                                                <option value="৳" {{ old('currency', $websitesetting->currency) == '৳' ? 'selected' : '' }}>৳</option>
                                                
                                              
                                            </select>
                                        </div>

                                    </div>

                         

                        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="header_logo">Header Logo</label>
                                            <input type="file" name="header_logo" id="header_logo"
                                                class="form-control">
                                            <img src="/images/{{ $websitesetting->header_logo }}" width="100px" height="100px"
                                                alt="">
                                        </div>

                                    
                                    </div>

                             

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
