@extends('layout.default')

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="">ProductManagement</a></li>
{{--                    <li class="breadcrumb-item active" aria-current="page">ProductManagement</li>--}}
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Administrators</h4>
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
                            <h4 class="header-title mt-0 mb-1">Administrative Module</h4>
                        </div>
                        <!-- <div class="col-lg-6">
                                <a href="{{ route('users.create') }}"
                                   class="btn btn-sm btn-soft-primary float-right  mr-2"
                                   data-toggle="tooltip" data-placement="top"
                                   title="Add User">
                                    <i class="uil uil-plus"> Add AO Admin</i>
                                </a>
                        </div> -->
                    </div>
                </div>

                <div class="table-responsive">
                    @if(count($collect))
                        <table class="table-hover table m-0 align-items-center table-flush" width="100%">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Sender Name</th>
                                <th>Reciever Name</th>
                                <th>Sender Location</th>
                                <th>Reciever Location</th>
                                <th>Sender Phone</th>
                                <th>Reciever Phone</th>
                                <th>Quantity</th>
                                <th>status</th>
								@if(auth()->check() && auth()->user()->type == 'Collection Officer')
                                <th>Action</th>
							@else
								@endif
                            </tr>  
                            </thead>
                            <tbody>
                            @foreach($collect as $key=>$t)
                                <tr>
                                <td>{{$key+1}}</td>
                                    <td>{{ ucwords($t->sender) }}</td>
                                    <td>{{ ucwords($t->reciever) }}</td>
                                    <td>{{ ucwords($t->from) }}</td>
                                    <td>{{ ucwords($t->to) }}</td>
                                    <td>{{ ucwords($t->sender_phone) }}</td>
                                    <td>{{ ucwords($t->reciever_phone) }}</td>


                                    <td>{{ ucwords($t->quantity) }}</td>

                                    @if ($t->status == 0)
                                    <td><div class="badge bg-danger text-wrap">
                                        Pending
                                      </div></td>
                                    @else
                                    <td><div class="badge bg-success text-wrap">
                                        Collected
                                      </div></td>
                                    @endif
									
									@if(auth()->check() && auth()->user()->type == 'Collection Officer')
                                    <td>
                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-light" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><span
                                                class="uil uil-ellipsis-v"></span></button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('bulk.update-parcel', $t->id) }}" method="get">
                                                @csrf
                                                <input type="hidden" name="to" value="{{ $t->to }}" />
                                                <input type="hidden" name="from" value="{{ $t->from }}" />
                                                <input type="hidden" name="quantity" value="{{ $t->quantity }}" />
                                                <input type="hidden" name="sender" value="{{ $t->sender }}" />
                                                <input type="hidden" name="reciever" value="{{ $t->reciever }}" />
                                                <input type="hidden" name="reciever_phone" value="{{ $t->reciever_phone }}" />
                                                <input type="hidden" name="sender_phone" value="{{ $t->sender_phone }}" />
												 <input type="hidden" name="receiver_id" value="{{ $t->receiver_id }}" />
                                                <input type="hidden" name="sender_id" value="{{ $t->sender_id }}" />
												 <input type="hidden" name="id" value="{{ $t->id}}" />
												@if ($t->status == 0)
                                                <button class="dropdown-item btn btn-link" href="#">Fetch Item</button>
                                                @else
                                                @endif                                            
											</form>
                                         
                                           
                                </td>
								@else
									@endif

                                
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
{{--                        {!! $users->links() !!}--}}
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

