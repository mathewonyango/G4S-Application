@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Parcel Management</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">Parcel Management</li>--}}
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">Shipment</h4>
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
                        <h4 class="header-title mt-0 mb-1">Shipment Management</h4>
                    </div>
                    @if(auth()->user()->type === 'Collection Officer'|| auth()->user()->type === 'super-admin' || auth()->user()->type === 'corporate')
                    <div class="col-lg-6">

                        <a href="{{ route('parcel.create') }}" class="btn btn-sm btn-soft-primary float-right  mr-2" data-toggle="Create Shipment">
                            <i class="uil uil-plus"> Add New Parcel</i>
                        </a>
                    </div>
					   @endif

					   <div class="col-lg-3">

                    <form action="{{ route('parcel.search') }}" method=" get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Search By Parcel ID">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </span>
                            </div>
                        </form>
                </div>
            </div>

            <div class="table-responsive">
                @if(count($parcels))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Parcel ID</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Sender Name</th>
                            <th scope="col">Sender Phone</th>
                            <th scope="col">Receiver Name</th>
                            <th scope="col">Receiver Phone</th>
                            <th scope="col">Status</th>
                            @if(auth()->user()->type === 'Collection Officer')
                            <th scope="col">Collected by</th>
                            @elseif(auth()->user()->type === 'Sorting Officer')
                            <th scope="col">Sorted by</th>
                            @elseif(auth()->user()->type === 'Sorting Officer')
                            <th scope="col">Dispatched by</th>
                            @else
							@endif
                            <th scope="col">Rider</th>
                            
                            <th class="text-center" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parcels as $key => $shipment)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ $shipment->parcel_id }}</td>
                            <td>{{ $shipment->from }}</td>
                            <td>{{ $shipment->to }}</td>
                            <td>{{ $shipment->sender}}</td>
                            <td>{{ $shipment->sender_phone }}</td>
                            <td>{{ $shipment->receiver}}</td>
                            <td>{{ $shipment->receiver_phone}}</td>

                           
                      
							    <td>
                                
									@if($shipment->status == 1)
									<span class="status-badge badge-infoo" style="color: blue;">Sorting</span>
									@elseif ($shipment->status == 2)
									<span class="status-badge badge-infoo" style="color: blue;">Dispatch</span>
									@elseif ($shipment->status == 3)
									<span class="status-badge badge-warningg" style="color: orange;">In Transit</span>
									@elseif ($shipment->status == 0)
									<span class="status-badge badge-warningg" style="color: orange;">Collection</span>
									@elseif ($shipment->status == 4)
									<span class="status-badge badge-primaryy" style="color: purple;">Pick Up Station</span>
									@elseif ($shipment->status == 6)
									<span class="status-badge badge-primaryy" style="color: purple;">Pick Up Station</span>
									@elseif ($shipment->status == 5)
									<span class="status-badge badge-successs" style="color: green;">Delivered</span>
									@else
									<span class="status-badge badge-dangerr" style="color: red;">Failed</span>
									@endif
								</td>
								@if(auth()->user()->type === 'Collection Officer')
								<td>{{ getMakerName($shipment->maker) }}</td>
								@elseif(auth()->user()->type === 'Sorting Officer')
								<td>{{ ($shipment->sorting)}}</td>
								@elseif(auth()->user()->type === 'Sorting Officer')
								<td>{{ ($shipment->dispatch)}}</td>
								@else
								@endif
							
							 @if($shipment->rider == null)
                            <td>Not Assigned</td>
                            @else
                            <td>{{getRiderName($shipment->rider)}}</td>
                            @endif
                            

                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="uil uil-ellipsis-v"></button>

                                    <div class="dropdown-menu">
                                        @if(auth()->user()->type == 'Sorting Officer'|| auth()->user()->type =='super-admin' || auth()->user()->type === 'corporate')
                                        <form method="POST" action="{{route ('parcel.sorting',$shipment->id)}}" onSubmit="approveButton.disabled = true; return true;">
                                            @csrf
                                            <input type="hidden" name="action" value="receive" />
                                            <input type="hidden" name="id" value="{{ $shipment ->id }}" />
                                            <input type="hidden" name="variance" value="{{ variance($shipment->id) }}" />
                                            @if($shipment->status == 0)
                                            <button type="submit" class="dropdown-item btn btn-link" onclick="return confirm('Are you sure you have Received?');" name="approveButton">Receive</button>
                                            @else
                                            @endif
                                        </form>
                                       
                                        <form action="{{route ('parcel.dispatch',$shipment->parcel_id)}}" method="get" onSubmit="approveButton.disabled = true; return true;">
                                            @csrf
                                            @if($shipment->status == 1)

                                            <input type="hidden" name="parcel_id" value="{{ $shipment ->parcel_id }}" />
                                            <input type="hidden" name="action" value="dispatch" />
                                            <button type="submit" class="dropdown-item btn btn-link" href="#">Dispatch</button>
                                            @else
                                            @endif
                                        </form>
										@endif
										 @if(auth()->user()->type == 'Sorting Officer'||auth()->user()->type == 'Collection Officer'|| auth()->user()->type =='super-admin' || auth()->user()->type === 'corporate')
										  <form method="POST" action="{{ route('pdf', ['parcel_id' => $shipment->parcel_id]) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="GET">
                                            <button class="dropdown-item btn btn-link"  type="submit">Generate receipt</button>
                                        
                                        </form>
                                        <form method="GET" action="{{route ('parcel.generate',$shipment->parcel_id)}}">
                                            @csrf
                                            <input type="hidden" name="parcel_id" value="{{ $shipment ->parcel_id }}" />
                                            <button class="dropdown-item btn btn-link"  type="submit">Generate QR Code</button>
                                        </form>
										
                                    
                                        @endif
                                    </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

				 {!! $parcels->links() !!}
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