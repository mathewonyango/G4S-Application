@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Branches</a></li>
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
                    <div class="col-lg-12">

                        <a href="{{ route('asset.create-branch-form') }}"
                           class="btn btn-sm btn-soft-primary float-right  mr-2"
                           data-toggle="Create Rider">
                            <i class="uil uil-plus"> New Branch</i>
                        </a>
                </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="header-title mt-0 mb-1">All Branches</h4>
                        </div>
                    </div>
                    <br>
                    @if(count($result->data))
                    <div class="row">
                        <div class="col-xl-12">
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Date Created</th>
                                    {{-- <th scope="col">Action</th> --}}

                                  </tr>
                                </thead>
                                <tbody>
                                @foreach( $result->data as $key=>$info)
                                  <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{ $info->branchName }}</td>
                                      <td>{{ $info->companyName }}</td>
                                      <td>{{ $info->createdByName }}</td>
                                      <td>{{  \Carbon\Carbon::parse($info->CreatedDate)->format('Y-m-d') }}</td>
                                      {{-- <td>Action</td> --}}
                                  </tr>

                                </tbody>
                                @endforeach
                              </table>

                        </div>
                    </div>

                    @else
                    <p>No data retrieved</p>

                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
