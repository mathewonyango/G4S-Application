@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Bikes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Motorbike Management</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">

                        <a href="{{ route('asset.create-asset') }}"
                           class="btn btn-sm btn-soft-primary float-right  mr-2"
                           data-toggle="Create Rider">
                            <i class="uil uil-plus"> Add a motorbike</i>
                        </a>
                </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">All Motorbikes</h4>
                        </div>
                    </div>
                    <br>
                    @if(count($bikes))
                    <div class="row">
                        <div class="col-xl-11">
                            <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bike Details</th>
                                    <th scope="col">Number Plate</th>
                                    <th scope="col">Chassis No</th>-
                                    <th scope="col">Engine Capacity</th>
                                    <th scope="col">Insurance Company</th>
                                    <th scope="col">Insurance No</th>
                                    <th scope="col">Insurance Expiry</th>
                                    <th scope="col"> Colour</th>
                                    <th scope="col"> Rider Name</th>
                                    <th scope="col"> Branch Name</th>
                                    <th scope="col"> Purchase Cost</th>
                                    <th scope="col"> Supplied By</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>

                                <tbody>
                                @foreach( $bikes as $key=>$bike)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $bike->make }}</td>
                                      <td>{{ $bike->plate_number }}</td>
                                      <td>{{ $bike->chassis_number }}</td>
                                      <td>{{ $bike->engine_capacity }}</td>
                                      <td>{{ $bike->insurance_company }}</td>
                                      <td>{{ $bike->insurance_number }}</td>
                                      <td>{{ $bike->insurance_expiry }}</td>
                                      <td>{{ $bike->color }}</td>
                                      <td>{{ $bike->RiderName }}</td>
                                      <td>{{ $bike->BranchName }}</td>
                                      <td>{{ $bike->purchase_cost }}</td>
                                      <td>{{ $bike->supplier_name }}</td>
                                      <td>
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-danger dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                          </button>
                                          <div class="dropdown-menu">
                                              <!-- <form action="{{ route('asset.assign-bike') }}" method="get">
                                                  @csrf
                                                  <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                                  {{-- <input type="hidden" name="bike_id" value="{{ $created_by }}" /> --}}
                                                  
                                                <button class="dropdown-item btn btn-link" href="#">Assign Bike</button>
                                              </form>
                                              <form action="{{ route('asset.return-bike') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Unassign Bike</button>
                                            </form> -->
                                              <form action="{{ route('asset.fuel-form') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Add Fuel</button>
                                            </form>
                                            <form action="{{ route('asset.service-form') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Add Service</button>
                                            </form>
                                            <form action="{{ route('asset.fuel-history') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Fuel History</button>
                                            </form>
                                            <form action="{{ route('asset.service-history') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Service History</button>
                                            </form>
                                            <form action="{{ route('asset.riders-history') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="bike_id" value="{{ $bike->id }}" />
                                              <button class="dropdown-item btn btn-link" href="#">Riders History</button>
                                            </form>
                                          </div>
                                        </div></td>


                                  </tr>

                                </tbody>
                                @endforeach
                              </table>

                        </div>
                    </div>

                    @else
                    <p>No data found</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
