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
                            <h4 class="header-title mt-0 mb-1">New Rider</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="
                                {{-- {{ route('rider.add-rider') }} --}}
                                " method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Model Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate"
                                            placeholder="Bike Registration No.">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Bike Reg No.</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate"
                                            placeholder="Bike Registration No.">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance certificate upload</label>
                                    <div class="col-9">
                                        <input type="file" class="form-control" id="cogc" name="goodconduct"
                                            placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance No</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate"
                                            placeholder="Certificate of insurance number">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Insurance Expiry Date</label>
                                    <div class="col-9">
                                        <input type="date" class="form-control" id="cogc" name="cog_expiry"
                                            placeholder="Expiry">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Chassis No</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="numberplate"
                                            placeholder="Bike Chassis No">
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
