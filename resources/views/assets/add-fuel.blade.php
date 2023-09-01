@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Asset</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Register Fuel Consumption</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('asset.submit-fuel-form') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Fuel Station</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="station"
                                            placeholder="Fuel Station">
                                    </div>
                                </div>
                                <input type="hidden" name="bike_id" value="{{ $bike_id }}"/>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Fuel Date</label>
                                    <div class="col-9">
                                        <input type="date" class="form-control" id="cogc" name="date_fuel"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Amount</label>
                                    <div class="col-9">
                                        <input type="number" class="form-control" id="cogc" name="amount"
                                            placeholder="Amount">
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
