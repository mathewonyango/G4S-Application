@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Admin Template</a></li>
                    <li class="breadcrumb-item"><a href="">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Role Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Create Role</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">New Role</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-soft-primary float-right"
                               rel="tooltip" data-placement="top"
                               title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back to Listing</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            {{ Form::open(array('route' => 'roles.create')) }}

                            <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('name', null, array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('name', 'Description') }}
                                {{ Form::text('description', '', array('class' => 'form-control')) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('type', 'Type') }}
                                <select class="form-control" id="type" name="type">
                                    <option value="app">app</option>
                                    <option value="web">portal</option>
                                </select>
                            </div>

                            <h6><b class="uil uil-edit-alt"> Assign Permissions</b></h6><br>

                            <div class='form-group'>
                                @foreach ($permissions as $permission)
                                    {{ Form::checkbox('permissions[]',  $permission->id ) }}
                                    {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                                @endforeach
                            </div>

                            {{ Form::button('<i class="uil uil-location-arrow"></i> Add', ['type' => 'submit', 'class' => 'btn btn-primary']) }}

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
