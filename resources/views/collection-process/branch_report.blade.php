@extends('layout.default')

@section('breadcrumb')
@if(count($all_shipments))<br>
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="">Shipments Management</a></li>
            </ol>
        </nav>
    </div>
</div>
</div>
<div class="col-sm-3">
<form action="{{ route('report.branch-report') }}" method="get">
                <div class="form-group">
                    <label for="branch"> Sort report by Branch:</label>
                    <select name="branch" id="branch" class="form-control">
                        @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->town_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row mb-3">
                    <label for="from_date" class="col-3 col-form-label">From:</label>
                    <div class="col-9">
                        <input type="datetime-local" class="form-control" id="from_date" name="from_date" placeholder="Start date">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="to_date" class="col-3 col-form-label">To:</label>
                    <div class="col-9">
                        <input type="datetime-local" class="form-control" id="to_date" name="to_date" placeholder="End date">
                    </div>
                </div>
                <button type="submit" name="submit" value="branch" class="btn btn-primary">Submit</button>

            </form>
</div>


</div>

@include('flash::message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="table-responsive">
                 <table class="table-hover table m-0 align-items-center table-flush table-sm table-striped">
                 <thead>
                            <tr>
                                <th scope="col">Parcel ID</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Sender Name</th>
                                <th scope="col">Sender Phone</th>
                                <th scope="col">Receiver Name</th>
                                <th scope="col">Receiver Phone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Collected by</th>
                                <th scope="col">Collected date</th>
                                <th scope="col">Sorted by</th>
                                <th scope="col">Dispatched by</th>
                                <th scope="col">Rider</th>
                                <th scope="col">Variance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all_shipments as $shipment)
                            <tr>
                                <td>{{ $shipment->parcel_id }}</td>
                                <td>{{ getRegionName($shipment->from) }}</td>
                                <td>{{ getRegionName2($shipment->to) }}</td>
                                <td>{{ $shipment->sender}}</td>
                                <td>{{ $shipment->sender_phone }}</td>
                                <td>{{ $shipment->receiver}}</td>
                                <td>{{ $shipment->receiver_phone}}</td>

                                @if ($shipment->status == 0)
                                <td>
                                    <div style="color: red;">Collection</div>
                                </td>
                                @elseif ($shipment->status == 1)
                                <td>
                                    <div style="color: blue;">Sorting</div>
                                </td>
                                @elseif ($shipment->status == 2)
                                <td>
                                    <div style="color: blue;">Dispatch</div>
                                </td>
                                @elseif($shipment->status == 3)
                                <td>
                                    <div style="color: orange;">In Transit</div>
                                </td>
                                @elseif($shipment->status == 4)
                                <td>
                                    <div style="color: purple;">Pick Up Station</div>
                                </td>
                                @elseif($shipment->status == 5)
                                <td>
                                    <div style="color: green;">Delivered</div>
                                </td>
                                @else
                                <td>
                                    <div style="color: red;">Not Delivered</div>
                                </td>
                                @endif
                               
                                <td>{{getMakerName($shipment->maker)}}</td>
                                <td>{{$shipment->created_at}}</td>

                                @if($shipment->sorting == '0')
                                <td>
                                    <span style="color: orange;">At Collection</span>
                                </td>
                                @else
                                <td>{{getMakerName($shipment->sorting)}}</td>
                                @endif

                                @if($shipment->dispatch == '0')
                                <td>
                                    <span style="color: green;">pending</span>
                                </td>
                                @else
                                <td>{{getMakerName($shipment->dispatch)}}</td>
                                @endif

                                @if($shipment->rider == null)
                                <td>
                                    <span style="color: blue;">Not Assigned</span>
                                </td>
                                @else
                                <td>{{getRiderName($shipment->rider)}}</td>
                                @endif

                                <td>{{variance($shipment->id)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                {{-- {!! $all_trips->links() !!} --}}

                @else
                <br>
                <div class="row">
                    <div class="alert alert-secondary container-fluid">
                        No records available
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
