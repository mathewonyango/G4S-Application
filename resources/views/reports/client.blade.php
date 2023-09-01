@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Client Management</a></li>
            </ol>
        </nav>
        <br>
        @if(count($all_clients))
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
                <table class="table-hover table m-0 align-items-center table-flush table-sm" width="100%">
                    <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Full Name</th>
                            <th>Contact</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Client Type</th>
                            <th>Corporate ID</th>
                            <th>Date Registered</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_clients as $client)
                        <tr>
                            <td>{{ ucwords($client->client_id) }}</td>
                            <td>{{ ucwords($client->fullname) }}</td>
                            <td>{{ $client->phone_number }}</td>
                            <td>{{ ucwords($client->email) }}</td>
                            @if ($client->is_active == 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    Active
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-danger text-wrap">
                                    Dormant
                                </div>
                            </td>
                            @endif

                            <td>{{ ucwords($client->client_type) }}</td>
                            <td>{{ ucwords($client->corporate_id) }}</td>
                            <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d-m-Y / h:i:s A')}}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {!! $all_clients->links() !!} --}}

                @else
                <br>
                <div class="row">
                    <div class="alert alert-secondary container-fluid">
                        No records found
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