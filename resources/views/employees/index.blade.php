@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Corporate</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Corporate Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">List of Employees Added</h4>
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
                            <h4 class="header-title mt-0 mb-1">Employees</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            @if(count($employees))
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Employee Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Email Address</th>
                                      <th scope="col">Status</th>
                                      <th scope="col">Action</th>

                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $employees as $key=>$employee )
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{ $employee->fullname }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>@if($employee->is_active == 1)
                                                Active
                                                @else
                                                Not Active
                                                @endif
                                        </td>

                                        <td><a class="text-danger" href="{{ route('corporate.delete',$employee->client_id) }}">Delete </a> |  <a href="{{ route('corporate.edit',$employee->client_id) }}">Change </a> </td>
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
                                    <h5 class="card-title">Something... Happenned but don't worry
                                    </h5>

                                  <p class="card-text"> You have not added any of your employees
                                </p>
                                  <a href="{{ route('client.create') }}" class="btn btn-link">Add Employees</a>
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
