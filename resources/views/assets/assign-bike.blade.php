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
            <h4 class="mb-1 mt-0">Assign Motorbike</h4>
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
                            <form action="{{ route('asset.submit-assign') }}" method="post" enctype="multipart/form-data">
                                @csrf
                               
                                <div class="form-group row mb-3">                
                                    <label for="role" class="col-3 col-form-label">Select Rider</label>
                                    <div class="col-9">
                                        <select name="rider_id" id="branch" class="form-group custom-select" required>
                                            <option value="">-- Select rider --</option>
                                            @foreach($riders as $rider)
                                                <option value="{{ $rider->id }}">{{ ucwords($rider->firstname) }} {{ ucwords($rider->lastname) }}</option>                                           
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                           
                                <div class="form-group row mb-3">
                                    <label for="gender" class="col-3 col-form-label">Motorbike</label>
                                    <div class="col-9">
                                        <select class="form-control" id="gender" name="bike_id">
                                        <option value="">--Select Motorbike --</option>
                                        @foreach ($bikes as $bike )
                                        <option value="{{ $bike->id}}">{{ $bike->model }} {{ $bike->plate_number }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Record Mileage</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="start_mileage"
                                            placeholder="mileage">
                                    </div>
                                </div>

                                
                                <div class="form-group row mb-3">
                                    <label for="cogc" class="col-3 col-form-label">Time In</label>
                                    <div class="col-9">
                                        <input type="datetime-local" class="form-control" id="cogc" name="time_in"
                                            placeholder="Time in">
                                    </div>
                                </div>

                                

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i
                                            class="uil uil-location-arrow"></i> Assign</button>
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
