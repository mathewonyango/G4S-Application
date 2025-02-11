@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Session</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Session Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Session</h4>
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
                            <h4 class="header-title mt-0 mb-1">Sessions List</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('create_location')
                                <a href="{{ route('location.create') }}" class="btn btn-sm btn-soft-primary float-right"
                                   rel="tooltip" data-placement="top" title="Add Location">
                                    <i class="uil uil-plus"> Set session</i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($locations))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Longitude</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locations as $location)
                                <tr>
                                    <td>{{ ucwords($location->name) }}</td>
                                    <td>{{ $location->longitude }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Longitude</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $locations->links() !!}
                    @else
                        <br>
                        <div class="row">
                            <div class="alert alert-info container-fluid">
                                No records found
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
