@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Roles</h4>
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
                            <h4 class="header-title mt-0 mb-1">Role Management</h4>
                        </div>
                        <div class="col-lg-6">
                       
                                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-soft-primary float-right"
                                   rel="tooltip" data-placement="top" title="Add Role">
                                    <i class="uil uil-plus"> Add Role</i>
                                </a>
                       
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $role)
                            <tr data-entry-id="{{ $role->id }}">

                                <td>{{ ucwords($role->name ?? '') }}</td>
                                <td>{{ strtolower($role->description ?? '') }}</td>
                                <td class="text-center">
                                
                                        <a href="{{ route('roles.edit', $role->id) }}" title="Edit Role" class="btn btn-outline-primary btn-sm" rel="tooltip"
                                           data-placement="top"><i class="uil uil-edit-alt"></i>
                                  
                                        <a href="{{ route('roles.show', $role->id) }}" title="view Role" class="btn btn-outline-primary btn-sm" rel="tooltip"
                                           data-placement="top"><i class="uil uil-eye"></i> view
                                        </a>
                              
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="float-right">
                        <hr class="m-1 mb-3">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
