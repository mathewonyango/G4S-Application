@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Rider</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rider Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Rider User</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('rider.update', $rider->id) }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="phonenumber" class="col-3 col-form-label">Phone Number</label>
                                    <div class="col-9">
                                        <input type="tel" class="form-control" id="phonenumber" name="phonenumber"
                                               placeholder="Enter phone number" value="{{ old('first_name', $rider->phonenumber) }}">
                                    </div>
                                </div>



                                <div class="form-group row mb-3">
                                    <label for="email3" class="col-3 col-form-label">Email address</label>
                                    <div class="col-9">
                                        <input type="email" class="form-control" name="email" id="email3" aria-describedby="emailHelp"
                                               placeholder="Enter email" value="{{ old('first_name', $rider->email) }}">
                                    </div>
                                </div>

                                {{-- <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Reg No.</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate" value="{{ old('first_name', $rider->number_plate) }}"
                                               placeholder="Bike Registration No.">
                                    </div>
                                </div> --}}
                                <div class="form-group row mb-3">
                                    <label for="phoneNumber" class="col-3 col-form-label">Action For App</label>
                                    <div class="col-9">
                                        <select class="form-control" name="status" required>
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
