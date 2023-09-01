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
            <h4 class="mb-1 mt-0">Return Motorbike</h4>
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
                                {{-- <div class="form-group row mb-3">
                                    <input type="hidden" name="bike_id" value="{{ $bike_id }}"/>
                                    <label for="role" class="col-3 col-form-label">Select Rider</label>
                                    <div class="col-9">
                                        <select name="rider_name" id="branch" class="form-group custom-select" required>
                                            <option value="">-- Select rider --</option>
                                            @foreach($riders as $rider)
                                                <option value="{{ $rider->id }}">{{ ucwords($rider->firstname) }} {{ ucwords($rider->lastname) }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row mb-3">
                                    <input type="hidden" name="bike_id" value="{{ $bike_id }}"/>
                                    <label for="cogc" class="col-3 col-form-label">Bike Recieved By</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="cogc" name="station"
                                            placeholder="Input name">
                                    </div>
                                </div>
                                {{-- <div class="form-group row mb-3">
                                    <input type="hidden" name="bike_id" value="{{ $bike_id }}"/>
                                    <label for="role" class="col-3 col-form-label">Select Bike Number</label>
                                    <div class="col-9">
                                        <select name="rider_name" id="branch" class="form-group custom-select" required>
                                            <option value="">-- Allocate bike--</option>
                                            @foreach($riders as $rider)
                                            <option  value="{{ $rider->rider_bike }}">{{ ucwords($rider->rider_bike) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row mb-3">
                                    <input type="hidden" name="end_mileage" value="{{ $end_mileage }}"/>
                                    <label for="phoneNumber" class="col-3 col-form-label">Record Mileage</label>
                                    <div class="col-9">
                                        <input type="text" class="form-control" id="phoneNumber"
                                               placeholder="mileage(km)"
                                               required value="{{ old('idnumber') }}" name="idnumber">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <input type="hidden" name="time in" value="{{ $created_at }}"/>
                                    <label for="cogc" class="col-3 col-form-label">Time Out</label>
                                    <div class="col-9">
                                        <input type="datetime-local" class="form-control" id="cogc" name="time_in"
                                            placeholder="Time out">
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
