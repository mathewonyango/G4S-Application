@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Admin Tempalte</a></li>
                    <li class="breadcrumb-item"><a href="">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
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
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-soft-primary float-right"
                               rel="tooltip" data-placement="top" title="Back to Roles">
                                <i class="uil uil-arrow-left"> Back to Roles</i>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-10">
                            {{ Form::model($role, array('route' => array('roles.edit', $role->id), 'method' => 'POST')) }}
                            {{ Form::token() }}
                            <div class="form-group">
                                {{ Form::label('name', 'Role Name') }}
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('description', 'Description') }}
                                {{ Form::text('description', null, array('class' => 'form-control')) }}
                            </div>

                            <h6><b class="uil uil-edit-alt"> Assign Permissions</b></h6><br>
                            @foreach ($permissions as $permission)

                                {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                                {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

                            @endforeach
                            <br>
                            {{ Form::button('<i class="uil uil-location-arrow"></i> Edit', ['type' => 'submit', 'class' => 'btn btn-primary'] )  }}

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
