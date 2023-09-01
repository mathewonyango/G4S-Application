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
        <h4 class="mb-1 mt-0">Assign Rider</h4>
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
                        <h4 class="header-title mt-0 mb-1">Select  Rider</h4>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-xl-10">
                        <form action="{{ route('corporate.postRider') }}" method="post">
                            @csrf
                            <input type="hidden" value={{$corporate_id}} name="corporate_id" />

                            <div class="form-group row mb-3">
                                <label for="riderName" class="col-3 col-form-label">Rider Name</label>
                                <div class="col-9">
                                    <select class="form-control" id="riderName" name="rider" required>
                                        @foreach ($riders as $rider)
                                        <option value="{{ $rider->id }}">
                                            {{ $rider->firstname . ' ' . $rider->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="supervisorName" class="col-3 col-form-label">Supervisor Name</label>
                                <div class="col-9">
                                    <select class="form-control" id="supervisorID" name="supervisorID" required>
                                        @foreach ($supervisors as $supervisor)
                                        <option value="{{ $supervisor->id }}">
                                            {{ $supervisor->firstname . ' ' . $supervisor->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row mb-3">
                                
                                <label for="lastName3" class="col-3 col-form-label"> Location</label>
                                <div class="col-9">
                                <div id="map-container2" class="">
                                <input id="pac-input" class="form-control" type="text" placeholder=" Location"
                                    name="from">
                                <div id="map" class="map2"></div>
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