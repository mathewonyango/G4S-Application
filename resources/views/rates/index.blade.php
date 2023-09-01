@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Rates Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Rates</h4>
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
                            <h4 class="header-title mt-0 mb-1">List of Rates</h4>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($rates))

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Package Type</th>
                                <th>Price</th>
								<th>Trip Type</th>
                                <th>Date Created</th>
                                <th>Date Modified</th>
                                <th>Action</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach (  $rates as $key=>$rate )
                                <tr>

                                    <td>{{$loop->iteration  }}</td>
                                    <td>{{$rate->package_type  }}</td>
                                    <td>{{$rate->type_of_trip  }}</td>
                                    <td>{{$rate->currency  }}{{$rate->price_rate  }}</td>
                                    <td>{{ Carbon\Carbon::parse($rate->created_at)->format('d-m-Y') }}</td>
                                    @if($rate->updated_at == null)
                                        <td>No Update Yet</td>
                                    @else
                                        <td>{{ \Carbon\Carbon::parse($rate->updated_at)->format('d-m-Y') }}</td>

                                    @endif
                                    <td>
                                            <a href="{{ route('rate.edit',$rate->id) }}"  class="btn btn-link"> <i class="uil uil-edit-alt"></i>Edit</a>
                                            {{-- <a href="{{ route('rate.remove',$rate->id) }}"  class="btn btn-link"> <i class="uil uil-trash"></i>Delete</a> --}}
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        {{-- {!! $riders->links() !!} --}}
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
