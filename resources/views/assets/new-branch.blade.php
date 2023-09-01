@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Branch</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Register New Branch</h4>
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
                            <h4 class="header-title mt-0 mb-1">New Branch</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('asset.branches') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Branch Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="branch_name"
                                            placeholder="Name of the Branch">
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Company Name</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="company_name"
                                            placeholder="Name of the Company">
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
