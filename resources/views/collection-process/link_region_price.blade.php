
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
            <h4 class="mb-1 mt-0">Add another region</h4>
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
                        <form action="{{ route('corporate.addMap') }}" method="post">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label for="fromRegion" class="col-3 col-form-label">From</label>
                                    <div class="col-9">
                                        <select class="form-control" id="from" name="from">
                                            <option value="">Select From Region</option>
                                            @foreach($regions as $region)
                                            {{ dd($regions)}}
                                                <option value="{{ $region->id }}">{{ $region->town_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="toRegion" class="col-3 col-form-label">To</label>
                                    <div class="col-9">
                                        <select class="form-control" id="to" name="to">
                                            <option value="">Select To Region</option>
                                            @foreach($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->town_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="name" class="col-3 col-form-label">Price</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="price" placeholder="Cost" name="price">
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
