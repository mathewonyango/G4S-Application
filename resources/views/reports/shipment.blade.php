@extends('layout.default')


@section('css')
<!-- plugin css -->
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shipments</li>
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">Reports</h4>
    </div>
</div>
@endsection

@section('content')
@include('flash::message')

<style>
#transactionReport {
    display: none;
}
</style>
<div class="row">
    <div class="col-lg-12">

        <button type="button" id="formButton" class="btn btn-primary mb-2">
            <i class="uil uil-cloud-download"></i>
            Download  Report
        </button>
        <button type="button" id="Button" class="btn btn-primary mb-2">
            <i class="uil uil-cloud-download"></i>
            Filter
        </button>

        <div class="card" id="transactionReport">
            <div class="card-body">
                <h4 class="header-title mt-0 mb-4">Filter to Download  Report</h4>

                <form action="{{ route('report.download-shipment') }}" method="post">
                    @csrf

                    <div class="row mb-5">
                    <div class="col">
                            <label for="agentType">Filter</label>
                            <select name="status" id="agentType" class="form-control">
                                <option value="">--Select Option--</option>
                                <option value="0">Collection</option>
                                <option value="1">Sorting</option>
                                <option value="2">Dispatch</option>
                                <option value="3">In Transit</option>
                                <option value="4">Pick up Station</option>
                                <option value="5">Delivered</option>
                                <option value="5">Failed</option>

                            </select>
                        </div>
                  
                        <div class="col">
                            <label>From</label>
                            <input type="date" name="from_date" class="form-control">
                        </div>
                        <div class="col">
                            <label>To</label>
                            <input type="date" name="to_date" class="form-control">
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">
                            <i class="uil uil-location-arrow"></i>
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mt-4 mb-4">Transaction Report</h4>

                <div class="table-responsive">
                @if(count($shipments))
                    <table class="table-hover table m-0 align-items-center table-flush" id="basic-datatable"
                        width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Parcel Code</th>
                                <th>Sender Location</th>
                                <th>Reciever Location</th>
                                <th>Weight</th>
                                <th> Quantity</th>
                                <th>Receiver Name</th>
                                <th>Sender Name</th>
                                <th>Sender Phone</th>
                                <th>Sender Phone</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Rider Name</th>
                                <th>Time Registered</th>
                            </tr>
                        </thead>
                        <tbody>
                  
                            @foreach($shipments as $key=>$item)
                            <tr>
                                <td>{{ $key++ }}</td>
                                <td>{{ ucwords($item->parcel_id) }}</td>
                                <td>{{ ucwords($item->from) }}</td>
                                <td>{{ $item->to }}</td>
                                <td>{{ $item->weight }}</td>
                                <td>{{ ucwords($item->quantity) }}</td>
                                <td>{{ $item->receiver }}</td>
                                <td>{{ $item->sender }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->sender_phone }}</td>
                                <td>{{ $item->receiver_phone }}</td>
                                @if ($item->status == 0)
                                    <td><div class="badge bg-success text-wrap">
                                        Collection
                                      </div></td>
                                      @elseif ($item->status == 1)
                                    <td><div class="badge bg-danger text-wrap">
                                        Sorted
                                      </div></td>
                                      @elseif ($item->status == 2)
                                    <td><div class="badge bg-danger text-wrap">
                                        Dispatched
                                      </div></td>
                                      @elseif ($item->status == 3)
                                    <td><div class="badge bg-danger text-wrap">
                                        In Transit
                                      </div></td>
                                      @elseif ($item->status == 4)
                                    <td><div class="badge bg-danger text-wrap">
                                        pick up
                                      </div></td>
                                      @elseif ($item->status == 5)
                                    <td><div class="badge bg-danger text-wrap">
                                      Delivered
                                      </div></td>
                                      @elseif ($item->status == 6)
                                    <td><div class="badge bg-danger text-wrap">
                                        failed
                                      </div></td>
                                    @else
                                    @endif                                
                                    <td>{{ $item->type }}</td>
                                <td>{{ $item->rider}}</td>
                                <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                               <th>No</th>
                                <th>Parcel Code</th>
                                <th>Sender Location</th>
                                <th>Reciever Location</th>
                                <th>Weight</th>
                                <th> Quantity</th>
                                <th>Receiver Name</th>
                                <th>Sender Name</th>
                                <th>Sender Phone</th>
                                <th>Sender Phone</th>
                                <th>Status</th>
                                <th>Type</th>
                                <th>Rider Name</th>
                                <th>Time Registered</th>
                            </tr>
                        </tfoot>
                    </table>
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
</div>
@endsection

@section('script')
<!-- datatable js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js') }}"></script>
<script>
$('#formButton').click(function() {
    $('#transactionReport').toggle()
});
</script>
@endsection

@section('script-bottom')
<!-- Datatables init -->
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>
@endsection