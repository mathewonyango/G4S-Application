@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Corporate</a></li>
                    <li class="breadcrumb-item active" aria-current="page">SMS Management</li>
                </ol>
            </nav>
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
                            <h4 class="header-title mt-0 mb-1">Messages</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            @if(count($query))
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Date Sent</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ( $query as $key=>$message )
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{ $message->fullname }}</td>
                                            <td>{{ $message->phone_number }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>@if($message->is_active == 1)
                                                    Active
                                                @else
                                                    Not Active
                                                @endif
                                            </td>

                                            <td><a class="text-danger" href="{{ route('corporate.delete',$message->client_id) }}">Delete </a> |  <a href="{{ route('corporate.edit',$employee->client_id) }}">Change </a> </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            @else
                                <div class="card text-center">
                                    <div class="card-header">
                                        Ooopss
                                    </div>
                                    <div class="card-body">
                                       No messages sent yet
                                    </div>

                                </div>

                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
