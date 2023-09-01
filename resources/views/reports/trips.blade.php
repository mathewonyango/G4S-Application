@extends('layout.default')

@section('breadcrumb')
@if(count($all_trips))<br><br>
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">trips Management</a></li>
            </ol>

        </nav>
    </div>
   
    <legend>Filter Reports</legend>
    <form action="{{ route('report.filter-trip')}}" method="get">
        <div class="text-center">
            <div class="form-group row mb-3">
                <label for="cogc" class="col-3 col-form-label">From:</label>
                <div class="col-9">
                    <input type="datetime-local" class="form-control" id="cogc" name="start_date" placeholder="start date">
                </div>
            </div>
            <div class="form-group row mb-3">
                <label for="cogc" class="col-3 col-form-label">To:</label>
                <div class="col-9">
                    <input type="datetime-local" class="form-control" id="cogc" name="end_date" placeholder="End date.">
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Filter data">
                <a class="btn btn-warning" href="{{ route('report.rider') }}">Export Data</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table-hover table m-0 align-items-center table-flush table-sm">
                    <thead>
                        <tr>
                            <th>Pickup <br> Address</th>
                            <th>Dropoff Address</th>
                            {{-- <th>package Type</th> --}}
                            <th>Type of trip</th>
                            <th>Revenue Generated</th>
                            {{-- <th>Status</th> --}}
                            <th>Time <br>Started</th>
                            <th>Time <br>Ended</th>
                            <th>Payment Type</th>
                            {{-- <th>Status</th> --}}
                            <th>Delivery Date</th>
                            <th>Receiver Name</th>
                            <th>Receiver Contact</th>
                            <th>trip <br>Number</th>
                            <th>Registered On</th>
                            <!-- <th>Mpesa <br>Ref</th> -->
                            <th>Payment Status</th>
                            <th>trip <br> Status </th>
                            <th>OrgAccountBalance</th>
                            <th>CreatedAt</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_trips as $trip)
                        <tr>
                            <td>{{ ucwords($trip->pickup_address) }}</td>
                            <td>{{ $trip->dropoff_address }}</td>
                            {{-- <td>{{ ucwords($trip->package_type) }}</td> --}}
                            <td>{{ ucwords($trip->type_of_trip) }}</td>
                            <td>{{ ucwords($trip->trip_cost) }}</td>
                            {{-- <td>{{ ucwords($trip->status) }}</td> --}}
                            <td>{{ ucwords($trip->started_time) }}</td>
                            <td>{{ ucwords($trip->end_time) }}</td>
                            <td>{{ ucwords($trip->payment_type) }}</td>
                            {{-- <td>{{ ucwords($trip->paid) }}</td> --}}
                            <td>{{ ucwords($trip->delivery_date) }}</td>
                            <td>{{ ucwords($trip->receiver_name) }}</td>
                            <td>{{ ucwords($trip->receiver_phone) }}</td>
                            <td>{{ ucwords($trip->trip_code) }}</td>
                            <td>{{ \Carbon\Carbon::parse($trip->created_at)->format('d-m-Y / h:i:s A')}}</td>

                            @if ($trip->paid== 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    Paid
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-danger text-wrap">
                                    Unpaid
                                </div>
                                @endif

                                @if ($trip->status == 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    Fulfilled
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-danger text-wrap">
                                    Dropped
                                </div>
                                @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {!! $all_trips->links() !!} --}}

                @else
                <br>
                <div class="row">
                    <div class="alert alert-secondary container-fluid">
                        No records available
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('modals.modal-delete')
@endsection

@section('script')
@include('scripts.delete-modal-script')
@endsection