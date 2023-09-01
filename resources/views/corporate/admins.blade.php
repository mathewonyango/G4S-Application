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
            <h4 class="mb-1 mt-0">Create Organization User</h4>
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
                            <h4 class="header-title mt-0 mb-1">Organization Super Admin</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('users.addusers') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstName3" class="col-3 col-fo03
                                    rm-label">First Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstName3" placeholder="First Name"
                                               required value="{{ old('first_name') }}" name="firstname">
                                    </div>
                                </div>
                                <input type="hidden" value="1" name="status" />
                                <input type="hidden" value="0" name="active" />
                                <input type="hidden" value={{$id}} name="corporate_id" />
                                <input type="hidden" value="corporate" name="type" />

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
                                        <input type="email" class="form-control" id="email3" placeholder="Email"
                                               required value="{{ old('email') }}" name="email">
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
                                        <input type="number" class="form-control" id="phoneNumber"
                                               placeholder="Phone Number"
                                               required value="{{ old('phone_number') }}" name="phonenumber">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Id Number</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="phoneNumber"
                                               placeholder="ID  Number"
                                               required value="{{ old('idnumber') }}" name="idnumber">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Address</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="phoneNumber"
                                               placeholder="Address"
                                               required value="{{ old('address') }}" name="address">
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
