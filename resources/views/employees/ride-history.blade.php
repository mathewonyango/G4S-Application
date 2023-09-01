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
            <h4 class="mb-1 mt-0">Trips by your employees</h4>
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
                            <h4 class="header-title mt-0 mb-1"> Trips</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            @if(count($rides))
                            <table class="table table-striped table-sm">
                                <thead>

                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">To</th>
                                    <th scope="col">From</th>
                                    <th scope="col">Trip Type</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Request Time</th>
                                    <th scope="col">Delivered Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rides as $key=>$trip )
                                    <tr>
                                        <th scope="row"> {{ $loop->iteration }}</th>
                                        <td>{{ $trip->client_name }}</td>
                                        <td>{{ str_replace('null,', '', $trip->dropoff_address) }}</td>
                                        <td>{{  str_replace('null,', '', $trip->pickup_address) }}</td>
                                        <td>{{ $trip->type_of_trip }}</td>
                                        <td>{{ $trip->trip_cost }}</td>
                                        <td>{{ $trip->requested_at }}</td>
                                        <td>{{ $trip->delivery_date }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                @else
                                <p>No rides found</p>
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
