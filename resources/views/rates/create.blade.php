@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Rates</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pricing</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Parcel Pricing</h4>
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
                            <h4 class="header-title mt-0 mb-1">Pricing</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('rate.post') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="firstname" class="col-3 col-form-label">Rates(KES)</label>
                                    <div class="col-9">
                                        <input type="title" class="form-control"  name="price_rate" placeholder="Rate Per Kilometre" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Client Type</label>
                                    <div class="col-9">
                                        <select class="form-control" id="" name="package_type">
                                            <option value="Corporate">Corporate</option>
                                            <option value="Normal">Normal</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Save</button>
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
