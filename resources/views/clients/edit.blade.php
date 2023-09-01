@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Edit Client</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        @can('view_roles')
                            <div class="col-lg-6">
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-soft-primary float-right"
                                   rel="tooltip" data-placement="top"
                                   title="Back to Users">
                                    <i class="uil uil-arrow-left"> Back to Users</i>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{route('corporate.update',  $corporate_client->client_id)}}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-form-label">Full Names</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder=""
                                               required value="{{ old('first_name', $corporate_client->fullname) }}
                                            " name="fullname" disabled>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="phoneNumber"
                                               placeholder="Phone Number"
                                               required value="{{ old('phone_number', $corporate_client->phone_number) }}" name="phonenumber">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Email Address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" id="email"
                                               placeholder="Email Address e.g. johndoe@yahoo.com"
                                               required value="{{ old('idnumber', $corporate_client->email) }}" name="email">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Action For App</label>
                                    <div class="col-9">
                                            <select class="form-control" name="is_active" required>
                                                <option value="">Select Actions Below</option>
                                                <option value="1">Enable Login</option>
                                                <option value="0">Disable Login</option>
                                            </select>
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
