@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Bikes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bike Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Register Motorbike</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Motorbike</h4>
                        </div>
                    </div>
                    <br>
                    {{-- {{ dd($result) }} --}}

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('asset.submit-bike') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="role" class="col-3 col-form-label">Select Branch and Company</label>
                                    <div class="col-9">
                                        <select name="branch" id="branch" class="form-group custom-select" required>
                                            @foreach($result->data as $branch)
                                                <option value="{{ $branch->id }}">{{ ucwords($branch->branchName) }} - {{ ucwords($branch->companyName) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Brand Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="brand"
                                            placeholder="Brand Name">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Model Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate"
                                            placeholder=" Model Name">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Engine Capacity</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="engine_capacity"
                                            placeholder="Engine Capacity">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Make Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="bike_make"
                                            placeholder="Bike Make Name">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Reg No.</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="reg_no"
                                            placeholder="Bike Registration No.">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance Company</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="insurance Company"
                                            placeholder="Insurance Company">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance certificate upload</label>
                                    <div class="col-9">
                                        <input type="file" class="form-control" id="cogc" name="insurance_cert"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance No</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="insurance_no"
                                            placeholder="Certificate of insurance number">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance Expiry Date</label>
                                    <div class="col-9">
                                        <input type="date" class="form-control" id="cogc" name="insurance_expiry"
                                            placeholder="Expiry">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Chassis No</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="chasis_no"
                                            placeholder="Bike Chassis No">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Purchase Cost in KES</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="cogc" name="purchase_cost"
                                            placeholder="Purchase cost">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Colour</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="color"
                                            placeholder="Colour">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Supplier Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="supplier"
                                            placeholder="Name of the supplier">
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
