@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Users</h4>
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
                            <h4 class="header-title mt-0 mb-1">Deactivated Users</h4>
                        </div>
                        <div class="col-lg-6">
                            @can('restore_user')
                                <a href="{{ route('users.index') }}" class="btn btn-sm btn-soft-primary float-right"
                                   rel="tooltip" data-placement="top"
                                   title="Back to Users">
                                    <i class="uil uil-arrow-left"> Back to Users</i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($users))
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Deleted On</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name. ' '.$user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>
                                    <td>{{ $user->deleted_at->format('F d, Y h:ia') }}</td>
                                    <td class="text-right">
                                        @can('restore_user')
                                            {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->id), 'method' => 'PUT', 'data-toggle' => 'tooltip', 'style'=>'display:inline-block')) !!}
                                            {!! Form::button('<i class="uil uil-refresh" ></i>', array('class' => 'btn btn-outline-success btn-sm', 'type' => 'submit', 'data-toggle' => 'tooltip', 'title' => 'Restore User'))!!}
                                            {!! Form::close() !!}
                                        @endcan
                                        @can('user_delete')
                                            {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'data-toggle' => 'tooltip', 'title' => 'Delete User Permanently', 'style'=>'display:inline-block')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button('<i class="uil uil-user-times"></i>', array('class' => 'btn btn-outline-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Deleted On</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    @else
                        <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-info container-fluid">
                                    No records found
                                </div>
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
