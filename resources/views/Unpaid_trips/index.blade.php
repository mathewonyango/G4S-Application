@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">Trip Management</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">User Management</li> --}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Trips Unpaid</h4>
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
                            {{-- <h4 class="header-title mt-0 mb-1">List of Unpaid data</h4> --}}
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    @if (count($data))

                        <table class="table table-sinfoed">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Rider FullName</th>
                                <th>Rider PhoneNumber</th>
                                <th>Client Name</th>
								<th>Client Contact</th>
                                <th>Date Delivered</th>
                                {{-- <th>Date Modified</th> --}}
                                <th>Action</th>



                            </tr>
                            </thead>
                            <tbody>
                            @foreach (  $data as $key=>$info)
                                <tr>

                                    <td>{{$loop->iteration  }}</td>
                                    <td>{{ ucwords($info->firstname .'   '.$info->lastname) }}</td>
                                    <td>{{$info->phonenumber  }}</td>
                                    <td>{{$info->fullname  }}</td>
                                    <td>{{$info->phone_number  }}</td>
                                    {{-- <td>{{$info-> }}</td> --}}
                                    <td>{{ Carbon\Carbon::parse($info->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                            <a href="{{ route('trip.trip-payment') }}"  class="btn btn-success"> </i>Add Payment</a>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                        {{-- {!! $data->links() !!} --}}
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
