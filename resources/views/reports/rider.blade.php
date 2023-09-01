{{-- @extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Rider Management</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Riders Report</h4>
        </div>
        <div class="text-center">
              <div class="form-group row mb-3">
            <label for="cogc" class="col-3 col-form-label">From </label>
            <div class="col-9">
                <input type="date" class="form-control" id="cogc" name="cog_expiry"
                    placeholder="Expiry">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="cogc" class="col-3 col-form-label">
                To
            </label>
            <div class="col-9">
                <input type="date" class="form-control" id="cogc" name="cog_expiry"
                    placeholder="Expiry">
            </div>
        </div> --}}
        {{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="file" name="file" class="form-control"> --}}
            {{-- <button class="btn btn-success">Import  Data</button> --}}
            {{-- <a class="btn btn-success" href="{{ route('mpesa-reports.rider') }}">Export  Data</a>
        </form>   --}} 
        {{-- </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card"> --}}
                {{-- <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">Administrative Module</h4>
                        </div>
                        <div class="col-lg-6">
                                <a href="{{ route('users.create') }}"
                                   class="btn btn-sm btn-soft-primary float-right  mr-2"
                                   data-toggle="tooltip" data-placement="top"
                                   title="Add User">
                                    <i class="uil uil-plus"> Add AO Admin</i>
                                </a>
                        </div>
                    </div>
                </div> --}}


                {{-- <div class="table-responsive">

                        <table class="table-hover table m-0 align-items-center table-flush table-sm" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Riders Name</th>
                                <th>Assigned by</th>
                                <th>Rider Status</th>
                                <th>Trip Cost</th>
                                <th>Status</th>
                                <th>Time started</th>
                                <th>Time ended</th>
                                <th>Payment Type</th>
                                {{-- <th>Status</th> --}}
                                {{-- <th>Delivery date</th>
                                <th>Receiver name</th>
                                <th>Receiver contact</th>
                                <th>Registered on</th>
                                <th>Trip Number</th>
                                <th>Paiyment Status</th> --}} 

                                {{-- <th>BillRefNumber</th>
                                <th>OrgAccountBalance</th>
                                <th>CreatedAt</th> --}}

                            {{-- </tr>
                            </thead>
                            <tbody>
                            @foreach($all_trips as $trip)
                                <tr>

                                    <td>{{ ucwords($trip->pickup_address) }}</td>
                                    <td>{{ $trip->dropoff_address }}</td>
                                    <td>{{ ucwords($trip->package_type) }}</td>
                                    <td>{{ ucwords($trip->type_of_trip) }}</td>
                                    <td>{{ ucwords($trip->trip_cost) }}</td>
                                    <td>{{ ucwords($trip->status) }}</td>

                                    <td>{{ ucwords($trip->started_time) }}</td>
                                    <td>{{ ucwords($trip->end_time) }}</td>
                                    <td>{{ ucwords($trip->payment_type) }}</td> --}}
                                    {{-- <td>{{ ucwords($trip->paid) }}</td> --}}
                                    {{-- <td>{{ ucwords($trip->delivery_date) }}</td>
                                    <td>{{ ucwords($trip->receiver_name) }}</td>
                                    <td>{{ ucwords($trip->receiver_phone) }}</td>
                                    <td>{{ ucwords($trip->InternalReference) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($trip->created_at)->format('d-m-Y / h:i:s A')}}</td> --}}
                                    {{-- <td>{{ ucwords($trip->payment_by) }}</td> --}}
                                    {{-- @if ($trip->payment_by== 1)
                                    <td><div class="badge bg-success text-wrap">
                                        Paid
                                      </div></td>
                                    @else
                                    <td><div class="badge bg-danger text-wrap">
                                        Unpaid
                                      </div>
                                      @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       {!! $all_trips->links() !!}

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

 --}}
