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
            <h4 class="mb-1 mt-0">Clients</h4>
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
                            <h4 class="header-title mt-0 mb-1">Clients' Feedback</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    {{-- @if (count($riders)) --}}

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Trip Code</th>
                                <th>Rating(Stars)</th>
                                <th>Feedbacks/Comments</th>
                                <th>Rated By</th>
                                <th>Time and Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $feedbacks as $key=>$feedback)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$feedback->trip_code}}</td>
                                <td>{{$feedback->stars}}</td>
                                <td>{{$feedback->feedback}}</td>
                                <td>{{$feedback->email}}</td>
                                <td> {{  \Carbon\Carbon::parse($feedback->created_at)->format('H:i:s / d-m-Y') }}</td>
                            </tr>
                            @endforeach

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
