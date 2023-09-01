@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Employee</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Employee Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Add Employee</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Employee</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('client.submit') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Full Names</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder="e.g. John Doe"
                                               required value="{{ old('first_name') }}" name="fullnames">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="phoneNumber"
                                               placeholder="Phone Number"
                                               required value="{{ old('phone_number') }}" name="phonenumber">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Department</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="phoneNumber"
                                               placeholder="Department"
                                               required value="{{ old('phone_number') }}" name="department">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Email Address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="email"
                                               placeholder="Email Address e.g. johndoe@yahoo.com"
                                               required value="{{ old('idnumber') }}" name="email">
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
