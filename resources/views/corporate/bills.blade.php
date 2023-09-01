@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Balance Management</a></li>
                </ol>
            </nav>
            <h4 class="text-primary"> Balance</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')

    <div class="container">
    <div class="col-md-12">
        <div class="invoice">
            <div class="invoice-content">
                <!-- begin table-responsive -->
                @if(!empty($my_rides->data))

                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                            <tr>
                                <th class="text-primary">Last 5 Transactions</th>

                            </tr>
                            </thead>
                            <tbody>
                            <div class="row">
                                <div class="col-xl-12">
                                    @if(!empty($my_rides->data))
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
                                        @foreach($my_rides->data as $key=>$trip )
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
                            </tbody>
                        </table>
                        <br/>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th><p class="text-danger">Outstanding Balance KES:</p>{{number_format($balance)}}</th>
                                        <th><p class="text-danger">Account Number:</p>{{$acc}}</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="invoice-footer">
                            <p class="text-center m-b-5 f-w-600">
                                THANK YOU FOR YOUR BUSINESS
                            </p>
                            <p class="text-center">
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> Outstanding Balance as at {{ Carbon\Carbon::now() }}</span>
                            </p>
                        </div>
                        <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print Copy</a>

                    </div>
                    @else
                    <div class="card">
                        <div class="card-body">
                            <p class="text-center m-b-5 f-w-600">
                                THANK YOU FOR YOUR BUSINESS
                            </p>
                            <p class="text-center">
                                <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> Outstanding Balance as at {{ Carbon\Carbon::now() }}</span>
                            </p>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-danger">Outstanding Balance : KES {{$balance}}</th> --}}
                                        <th><p class="text-danger">Outstanding Balance KES:</p>{{number_format($balance)}}</th>
                                        <th><p class="text-danger">Account Number:</p>{{$acc}}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print Copy</a>

                    </div>

                    @endif

            </div>


        <!-- end invoice-footer -->
        </div>
    </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection

