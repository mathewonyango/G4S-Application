@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Checker</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Group Details</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Group Details</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" id="pills-tab" role="tablist">

                        @if(count($result))

                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                Pending PIN Change Requests
                            </a>
                        </li>
                        @else

                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="true">
                                No Pending PIN Change Requests
                            </a>
                        </li>

                        @endif
                    </ul>
                    @if(count($result))
                    <h5 class="mt-3"> Members</h5>
                         <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Names</th>
                                <th>Contact</th>
                                <th>Member No</th>
                                <th>ID No</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $user)
                                <tr>
                                    <td>{{ $user->firstname .' '. $user->lastname }}</td>
                                    <td>{{ $user->phonenumber }}</td>
                                    <td>{{ $user->member_number }}</td>
                                    <td>{{ $user->idnumber }}</td>
                                    <td>
                               <form action="{{ route('group.changepin') }}" method="get">
                                 <input type="hidden" class="form-control" id="phone" value="{{ $user->phonenumber }}" name="phone">
                                 <div class="col-auto">
                                 <button type="submit" class="btn btn-info btn-sm"> Confirm PIN Reset</button>
                                     </div>
                                 </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @else
                            <br>
                            <div class="row">
                                <div class="alert alert-secondary container-fluid">
                                    No Requests available
                                </div>
                            </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
@endsection

