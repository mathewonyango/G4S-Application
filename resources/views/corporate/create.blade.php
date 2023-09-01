@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Corporate</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Corporate Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Create Corporate</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">New Corporate</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('corporate.submit') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Corporate Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder="Corporate Name"
                                               required  name="name">
                                    </div>
                                </div>


                                <div class="form-group row mb-3">
                                    <label for="lastName3" class="col-3 col-form-label">Corporate Address</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="lastName3" placeholder="Corporate Address (Include Postal Code)"
                                               required value="{{ old('last_name') }}" name="address">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="lastName3" class="col-3 col-form-label">Physical Location</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="lastName3" placeholder=" Physical Location"
                                               required value="{{ old('last_name') }}" name="location">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Corporate Email Address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="email3" placeholder="Corporate Email Address"
                                               required value="{{ old('email') }}" name="email">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Corporate Phone Number</label>
                                    <div class="col-9">
                                        <input type="phone" class="form-control" id="username" placeholder="Corporate Phone Number"
                                               required  name="phonenumber">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Company Contact Person</label>
                                    <div class="col-9">
                                        <input type="phone" class="form-control" id="username" placeholder="Full Names"
                                               required  name="contact_person">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Designation</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="username" placeholder="Designation"
                                               required  name="designation">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
