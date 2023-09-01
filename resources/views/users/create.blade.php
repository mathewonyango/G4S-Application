@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">AO Group</a></li>
                <li class="breadcrumb-item active" aria-current="page">Admin Management</li>
            </ol>
        </nav>

        <h4 class="mb-1 mt-0">Add another user</h4>
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
                        <h4 class="header-title mt-0 mb-1"> Super Admin</h4>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-xl-10">
                        <form action="{{ route('users.addusers') }}" method="post">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="firstName3" class="col-3 col-form-label">First Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="firstName3" placeholder="First Name"
                                        required value="{{ old('first_name') }}" name="firstname">
                                </div>
                            </div>
                            <input type="hidden" value="1" name="status" />
                            <input type="hidden" value="0" name="active" />
                            <input type="hidden" value="" name="corporate_id" />


                            <div class="form-group row mb-3">
                                <label for="lastName3" class="col-3 col-form-label">Last Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control" id="lastName3" placeholder="Last Name"
                                        required value="{{ old('last_name') }}" name="lastname">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email3" class="col-3 col-form-label">Email Address</label>
                                <div class="col-9">
                                    <input type="email" class="form-control" id="email3" placeholder="Email" required
                                        value="{{ old('email') }}" name="email">
                                </div>
                            </div>

                            {{-- <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Username</label>
                                    <div class="col-9">
                                        <input type="username" class="form-control" id="username" placeholder="Username"
                                               required value="{{ old('username') }}" name="username">
                    </div>
                </div> --}}


                <div class="form-group row mb-3">
                    <label for="phoneNumber" class="col-3 col-form-label">Phone Number</label>
                    <div class="col-9">
                        <input type="number" class="form-control" id="phoneNumber" placeholder="Phone Number" required
                            value="{{ old('phone_number') }}" name="phonenumber">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="employee_number" class="col-3 col-form-label">Employee number</label>
                    <div class="col-9">
                        <input type="employee_number" class="form-control" id="employee_number"
                            placeholder="Employee Number" required value="{{ old('employee_number') }}"
                            name="employee_number">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="phoneNumber" class="col-3 col-form-label">Id Number</label>
                    <div class="col-9">
                        <input type="number" class="form-control" id="phoneNumber" placeholder="ID  Number" required
                            value="{{ old('idnumber') }}" name="idnumber">
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="phoneNumber" class="col-3 col-form-label">Address</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="phoneNumber" placeholder="Address" required
                            value="{{ old('address') }}" name="address">
                    </div>
                </div>

                <!-- <option value="">Select Role</option> -->


                @if(auth()->check() && auth()->user()->type == 'Admin')

                <div class="form-group row mb-3">
                    <label for="role" class="col-3 col-form-label">Role</label>
                    <div class="col-9">
                        <select class="form-control" id="role" name="role">
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif


                @if(auth()->check() && auth()->user()->type == 'super-admin')

                <div class="form-group row mb-3">
                    <label for="region" class="col-3 col-form-label">Region</label>
                    <div class="col-9">
                        <select class="form-control" id="region_code" name="region_code">
                            @foreach ($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->town_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @endif
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-location-arrow"></i>
                        Submit</button>
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