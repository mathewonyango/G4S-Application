@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Client Management</a></li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0"> Clients</h4>
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
                            <h4 class="header-title mt-0 mb-1">Client Management</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($clients))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Client ID</th>
                                <th scope="col">Full Names</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Client Type</th>
                                <th scope="col">Date Registered</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $key=>$user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{ $user->client_id }}</td>
                                    <td>{{ ucwords($user->fullname) }}</td>
                                    <td>{{ ucwords($user->email) }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->client_type }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y / h:i:s A')}}
                                    
                                    @if ($user->is_active == 1)
                                    <td><div class="badge bg-success text-wrap">
                                        Active
                                      </div></td>
                                    @else
                                    <td><div class="badge bg-danger text-wrap">
                                        Inactive
                                      </div></td>
                                    @endif

                            @endforeach
                            </tbody>
                        </table>
                        {{ $clients->links() }}
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

    