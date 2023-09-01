@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Permissions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permissions Listing</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Permissions</h4>
        </div>
    </div>
@endsection

@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">Permissions List</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                        <thead>
                        <tr>
                            <th>Permisison</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ ucwords($permission->name) }}</td>
                                <td>{{ ucwords($permission->description) }}</td>
                                <td>{{ carbon($permission->created_at)->format('M j, Y g:i A') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Permission</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="float-right">
                        <hr class="m-1 mb-3">
                        {{ $permissions->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
@endsection
