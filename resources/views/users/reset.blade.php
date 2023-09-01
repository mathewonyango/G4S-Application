@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Password Reset</a></li>
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
                            <h4 class="header-title mt-0 mb-1">Password Reset</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($users))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ ucwords($user->firstname .' '. $user->lastname) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ucwords($user->role) }}</td>
                                    @if ($user->status == 1)
                                    <td><div class="badge bg-success text-wrap">
                                        Active
                                      </div></td>
                                    @else
                                    <td><div class="badge bg-danger text-wrap">
                                        Disabled
                                      </div></td>
                                    @endif
                                    <td class="text-center">
                                        @if($user->id !=auth()->user()->id)
                                            @can('manage_users')
                                            <a href="{{ route('users.reset-password', $user->id) }}" data-toggle="tooltip"
                                                class="btn btn-outline-primary btn-sm " data-original-title=""
                                                   title="Reset Password"> Reset Password
                                                </a>
                                            @endcan
                                        @else
                                            <a type="button" href="{{ route('settings.profile') }}" rel="tooltip"
                                               class="btn btn-outline-primary btn-sm " data-original-title=""
                                               title="Edit Profile">
                                                <i class="uil uil-edit-alt"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        {!! $users->links() !!}
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
    @include('modals.modal-delete')
@endsection

@section('script')
    @include('scripts.delete-modal-script')
@endsection

