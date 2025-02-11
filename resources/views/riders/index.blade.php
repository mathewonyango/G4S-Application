@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Riders Management</a></li>
                {{--                    <li class="breadcrumb-item active" aria-current="page">User Management</li>--}}
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">Riders</h4>
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
                        <h4 class="header-title mt-0 mb-1">Rider Management</h4>
                    </div>
                    <div class="col-lg-6">

                        <a href="{{ route('rider.create') }}" class="btn btn-sm btn-soft-primary float-right  mr-2"
                            data-toggle="Create Rider">
                            <i class="uil uil-plus"> Create New Rider</i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                @if(count($riders))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Employer No.</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">ID Number</th>
                            {{-- <th scope="col">Bike Reg No</th> --}}
                            <th>Type</th>
                            <th scope="col">KRA PIN</th>
                            <th scope="col">Online Status</th>
                            <th scope="col">Trip Status</th>
                            <th scope="col">Bke Status</th>


                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riders as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ ucwords($user->firstname .' '. $user->lastname) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->employer_number }}</td>

                            <td>{{ $user->phonenumber }}</td>
                            <td>{{ $user->idnumber }}</td>
                            {{-- <td>{{ $user->number_plate }}</td> --}}
                            <td>{{ getRiderType($user->role) }}</td>
                            <td>{{ $user->krapin }}</td>
                            @if ($user->is_online == 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    Online
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-warning text-wrap">
                                    Offline
                                </div>
                            </td>
                            @endif
                            @if ($user->has_trip == 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    ON Trip
                                </div>
                            </td>
                            @else
                            <td>
                                <div class="badge bg-danger text-wrap">
                                    OFF Trip
                                </div>
                            </td>
                            @endif
                            @if ($user->bike_status == 1)
                            <td>
                                <div class="badge bg-success text-wrap">
                                    Assigned
                                </div>
                            </td>
                            @elseif($user->bike_status == 0)
                            <td>
                                <div class="badge bg-danger text-wrap">
                                    UnAssigned
                                </div>
                            </td>
                            @endif
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-light" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"><span
                                            class="uil uil-ellipsis-v"></span></button>
                                    <div class="dropdown-menu">
                                        <form action="{{ route('rider.edit',$user->id) }}" method="get">
                                            @csrf
                                            <button class="dropdown-item btn btn-link" href="#">Edit </button>
                                        </form>

                                        <form action="#" method="">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}" />
                                            @if($user->bike_status == 0)

                                            <button class="dropdown-item btn btn-link" href="javascript:void(0)" data-toggle="modal"
                                                data-target="#AssignBike" id="btn-new-event">Assign Bike</button>
                                                @else
                                            @endif
                                        </form>
                                        <form method="POST" action="{{route ('rider.unassign',$user->id)}}" onSubmit="approveButton.disabled = true; return true;">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}" />
                                            @if($user->bike_status == 1)
                                            <button type="submit" class="dropdown-item btn btn-link" onclick="return confirm('Are you sure you want to Un Assign Bike from this Rider?');" name="approveButton">Un Assign Bike</button>
                                            @else
                                            @endif
                                        </form>
                                       
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{  $riders->links()  }}
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
@include('modals.assign-bike')
@endsection

@section('script')
@include('scripts.delete-modal-script')
@endsection