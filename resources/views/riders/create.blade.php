
@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Riders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rider Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Create Rider</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Rider</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('rider.add-rider') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstname" class="col-3 col-form-label">First Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="lastname" class="col-3 col-form-label">Last Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter last name">
                                    </div>
                                </div>
								
								 <div class="form-group row mb-3">
                                    <label for="lastname" class="col-3 col-form-label">Employer No.</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" name="emp_number" id="emp_number" placeholder="Enter Employer No">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="dateofbirth" class="col-3 col-form-label">Date of Birth</label>
                                    <div class="col-9">
                                        <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="Enter Date of Birth">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="idnumber" class="col-3 col-form-label">Passport Size-Photo</label>
                                    <div class="col-9">
                                        <input type="file" class="form-control" id="idnumber" name="avatar">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="krapin" class="col-3 col-form-label">KRA Pin</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="krapin" name="krapin" placeholder="Enter KRA pin">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="krapin" class="col-3 col-form-label">ID Number</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="krapin" name="idnumber" placeholder="ID Number">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="phonenumber" class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                        <input type="tel" class="form-control" id="phonenumber" name="phonenumber"
                                            placeholder="Enter phone number">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Gender</label>
                                    <div class="col-9">
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Email address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" name="email" id="email3" aria-describedby="emailHelp"
                                            placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Good Conduct Upload</label>
                                    <div class="col-9">
                                        <input type="file" class="form-control" id="cogc" name="upload_goodconduct"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Cert of Good Conduct No.</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="goodconduct"
                                            placeholder="Certificate of good conduct number">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Good Conduct Expiry Date</label>
                                    <div class="col-9">
                                        <input type="date" class="form-control" id="cogc" name="cog_expiry"
                                            placeholder="Expiry">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Motorbike</label>
                                    <div class="col-9">
                                        <select class="form-control" id="gender" name="motor_id">
                                        <option value="">--Select Motorbike --</option>
                                        @foreach ($bikes as $bike )
                                        <option value="{{ $bike->id}}">{{ $bike->model }} {{ $bike->plate_number }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                 <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Role</label>
                                    <div class="col-9">
                                        <select class="form-control" id="gender" name="role">
                                        <option value="">--Select User Role --</option>
                                        @foreach ($roles as $role )
                                        <option value="{{ $role->id}}">{{ $role->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Submit</button>
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
