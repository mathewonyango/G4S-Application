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
                            <h4 class="header-title mt-0 mb-1">Fuel History</h4>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Filling Station</th>
                                    <th scope="col">Number Plate</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Fuelling Date </th>
                                    <th scope="col">Date Registered</th>
                                    <th scope="col">Created By</th>

                                  </tr>
                                </thead>
                                <tbody>
                                @foreach( $result->data as $key=>$info)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $info->station }}</td>
                                      <td>{{ $info->number_plate }}</td>
                                      <td>{{ number_format($info->amount) }}</td>
                                      <td>{{  \Carbon\Carbon::parse($info->fueling_date)->format('Y-m-d') }}</td>
                                      <td>{{  \Carbon\Carbon::parse($info->created_at)->format('Y-m-d') }}</td>
                                      <td>{{ $info->createdByName }}</td>
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
