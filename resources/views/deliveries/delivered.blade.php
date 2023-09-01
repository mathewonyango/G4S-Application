@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Deliveries</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Trips Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Delivered Trips</h4>
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
                            <h4 class="header-title mt-0 mb-1">Delivered Trips</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            @if(count($trips))
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Client Name</th>
                                    <th scope="col">Rider</th>
                                    <th scope="col">Pick Up Location</th>
                                    <th scope="col">Drop Off Location</th>
                                    <th scope="col">Package Type</th>
                                    <th scope="col">Client Type</th>
                                    <th scope="col">Trip Cost</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">Was Delivered at</th>
                                    <th scope="col">Payment Status</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trips as $key=>$trip )
                                    <tr>
                                        <th scope="row"> {{ $loop->iteration }}</th>
                                        <td>{{ $trip->fullname }}</td>
                                        <td>{{ $trip->rider_email }}</td>
                                        <td>{{ $trip->pickup_address }}</td>
                                        <td>{{ $trip->dropoff_address }}</td>
                                        <td>{{ $trip->package_type }}</td>
                                        <td>{{ $trip->client_type }}</td>
                                        <td>{{ $trip->trip_cost }}</td>
                                        <td>{{ $trip->started_time }}</td>
                                        <td>{{ $trip->end_time }}</td>
                                        @if($trip->paid === '0' )
                                        <td class="text-danger">Not Paid</td>
                                        @else
                                        <td class="text-success">Paid</td>
                                        @endif

                                    </tr>

                                @endforeach
                                </tbody>
                                {{-- {{$trip->links()}} --}}
                            </table>
                            {!! $trips->links() !!}


                                @else
                                <p>No successful trips yet</p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
