@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Bikes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Motorbike Management</li>
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
                            <h4 class="header-title mt-0 mb-1">All Motorbikes</h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table table-striped table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bike Details</th>
                                    <th scope="col">Number Plate</th>
                                    <th scope="col">Chassis No</th>-
                                    <th scope="col">Engine Capacity</th>
                                    <th scope="col">Insurance Company</th>
                                    <th scope="col">Insurance No</th>
                                    <th scope="col">Insurance Expiry</th>
                                    <th scope="col"> Colour</th>
                                    <th scope="col"> Rider Name</th>
                                    <th scope="col"> Branch Name</th>
                                    <th scope="col"> Purchase Cost</th>
                                    <th scope="col"> Supplied By</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>

                                <tbody>
                                @foreach( $bikes as $key=>$bike)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $bike->make }}</td>
                                      <td>{{ $bike->plate_number }}</td>
                                      <td>{{ $bike->chassis_number }}</td>
                                      <td>{{ $bike->engine_capacity }}</td>
                                      <td>{{ $bike->insurance_company }}</td>
                                      <td>{{ $bike->insurance_number }}</td>
                                      <td>{{ $bike->insurance_expiry }}</td>
                                      <td>{{ $bike->color }}</td>
                                      <td>{{ $bike->RiderName }}</td>
                                      <td>{{ $bike->BranchName }}</td>
                                      <td>{{ $bike->purchase_cost }}</td>
                                      <td>{{ $bike->supplier_name }}</td>
                                      <td>Action</td>


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
