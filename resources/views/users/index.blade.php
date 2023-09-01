@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">User Management</a></li>
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">Administrators</h4>
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
                        <h4 class="header-title mt-0 mb-1">Administrative Module</h4>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-soft-primary float-right mr-2"
                            data-toggle="tooltip" data-placement="top" title="Add User">
                            <i class="uil uil-plus"></i> Add System Users
                        </a>

                    </div>


                </div>
            </div>

            <div class="table-responsive">
                @if(count($users))
                <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Employer No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ ucwords($user->firstname .' '. $user->lastname) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucwords($user->type) }}</td>
                            <td>{{ $user->employee_number }}</td>
                            @if ($user->status == 1)
                            <td>
                                <div class="badge bg-success text-wrap">Active</div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-danger text-wrap">Disabled</div>
                            </td>
                            @endif

                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('users.reset-password', $user->id) }}"
                                        class="btn btn-outline-primary btn-sm mr-2" data-original-title="Reset Password"
                                        title="Reset Password">
                                        Password Reset
                                    </a>

                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-secondary btn-sm mr-2" data-original-title="Edit Profile"
                                        title="Edit Profile">
                                        Edit
                                    </a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="modal"
                                            data-original-title="Delete User" title="Delete User">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @include('modals.modal-delete', ['id' => $user->id])
                        @endforeach
                    </tbody>
                </table>

                @else
                <br>
                <div class="row">
                    <div class="alert alert-secondary container-fluid">
                        No records found
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@include('scripts.delete-modal-script')
@endsection