@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Clients Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">AO Admin</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">List of SMS</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>SMS Sent/Message</th>
                                <th>Category</th>
                                <th>Date Sent</th>
                                <th>Sender</th>

                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Send your parcel tommorrow free! use code AD46562DCC</td>
                                    <td>Customers</td>
                                    <td>{{ Carbon\Carbon::now()->format('Y-m-d h:m')}}</td>
                                    <td>Ephantus</td>

                                </tr>


                            </tbody>
                        </table>

                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection
