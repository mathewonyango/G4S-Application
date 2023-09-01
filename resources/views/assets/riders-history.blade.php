@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Asset Management</li>
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
                            <h4 class="header-title mt-0 mb-1">List of Riders</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Number Plate</th>
                                    <th scope="col">Rider's Names</th>
                                    <th scope="col">Assigned By</th>
                                    <th scope="col">Rider's Time In</th>
                                    <th scope="col">Initial Mileage</th>
                                    <th scope="col">Recieved By</th>
                                    <th scope="col">Rider's Time Out</th>
                                    <th scope="col">End Mileage</th>
                                    

                                  </tr>

                                </thead>
                                <tbody>
                                @foreach( $result->data as $key=>$info)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $info->number_plate }}</td>
                                      <td>{{ $info->riderName }}</td>
                                      <td>{{ $info->createdByName }}</td>
                                      <td>{{ $info->created_at}}</td>
                                      <td>{{ $info->start_mileage}}</td>
                                      <td>{{ $info->receivedByName }}</td>
                                      <td>{{ $info->received_at}}</td>
                                      <td>{{ $info->end_mileage}}</td>

                                      
                                  </tr>

                                </tbody>
                                @endforeach
                              </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
