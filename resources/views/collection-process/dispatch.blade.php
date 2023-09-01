@extends('layout.default')

<script>
    $(function() {
        $('#cred').change(function() {
            $('.disp').hide();
            $('#bank').show();
            var vax =$('#' + $(this).val());
            console.log("VAX", vax)
            $('#' + $(this).val()).show();
            $('#bank').show();


        });
    });
</script>

@section('breadcrumb')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="">Corporate</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Corporate Management</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Dispatch Parcel</h4>
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
                            {{-- <h4 class="header-title mt-0 mb-1">Dispatch Shipment</h4> --}}
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('parcel.index') }}" class="btn btn-sm btn-primary float-right" rel="tooltip"
                                data-placement="top" title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back Home</i>
                            </a>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">
                            <form action="{{ route('parcel.update')}}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="dispatch" />

                                <div class="form-group row mb-3">
                                    <label for="parcel_id" class="col-3 col-form-label">Parcel_id</label>
                                    <div class="col-9">
                                    <input  name="parcel_id" value="{{$parcel_id}}"/>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label for="from" class="col-3 col-form-label">Assign rider</label>
                                    <div class="col-9">
                                       <select class="form-control" id="riderName" name="rider" required>
                                    </div>  <option value=""> -- Select Sender Location --</option>
                                        @foreach ($riders as $rider)
                                        <option value="{{ $rider->id }}">
                                            {{ $rider->firstname . ' ' . $rider->lastname }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="role" class="col-3 col-form-label">Select Shipment Type
                                    </label>
                                    <div class="col-9">
                                        <Select id="type" class="form-group custom-select"  name="deliverytype" required>
                                            <option value="">-- Choose --</option>
                                            <option value="client">client</option>
                                            <option value="warehouse">Warehouse</option>
                                        </Select>
                                    </div>
                                </div>
                                
                                <br />

                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-search"></i>
                                        Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
