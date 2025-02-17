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
            <h4 class="mb-1 mt-0">New Parcel</h4>
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
                            {{-- <h4 class="header-title mt-0 mb-1">New Parcel</h4> --}}
                        </div>
                     
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xl-10">

                            <form action="{{ route('bulk.process-collect') }}" method="post">
                                @csrf
								<input type="hidden" name="id" value="{{ $id }}"/>	
                                <div class="form-group row mb-3">
                                    <label for="weight" class="col-3 col-form-label">Sender Location</label>
                                    <div class="col-9">
                                    <strong>{{ $to }} </strong>
                                    <input type="hidden" name="to" value="{{ $to }}"/>           
                                    </div>
                                </div>

                                <input type="hidden" name="sender" value="{{ $sender }}"/>    
                                <input type="hidden" name="reciever" value="{{ $reciever }}"/>     
                                <input type="hidden" name="sender_phone" value="{{ $sender_phone }}"/>  
                                <input type="hidden" name="reciever_phone" value="{{ $reciever_phone }}"/> 
								<input type="hidden" name="receiver_id" value="{{ $receiver_id }}" />
                                <input type="hidden" name="sender_id" value="{{ $sender_id }}" /> 								
         
                                <div class="form-group row mb-3">
                                    <label for="weight" class="col-3 col-form-label">Reciever Location</label>
                                    <div class="col-9">
                                    <strong>{{ $from }} </strong>
                                    <input type="hidden" name="from" value="{{ $from }}"/>           
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="weight" class="col-3 col-form-label">Quantity</label>
                                    <div class="col-9">
                                    <strong>{{ $quantity }} </strong>
                                    <input type="hidden" name="quantity" value="{{ $quantity }}"/>           
                                    </div>
                                </div>

                             
   
                                <div class="form-group row mb-3">
                                    <label for="role" class="col-3 col-form-label">Select Shipment Type
                                    </label>
                                    <div class="col-9">
                                        <Select id="type" class="form-group custom-select"  name="type" required>
                                            <option value="">-- Choose --</option>
                                            <option value="cover">Cover</option>
                                            <option value="mailbag">Mailbag</option>
                                            <option value="bulky">Parcel/Bulky</option>
                                        </Select>
                                        <br />

                                                <div class="col-9 disp" id="cover" style="display:none">
                                                    <input type="text" class="form-control" id="type_cover"
                                                        placeholder="Input Weight" name="type_cover">
                                                </div>
                                                <div class="col-9 disp" id="bulky" style="display:none">
                                                    <input type="text" class="form-control" id="bulky"
                                                        placeholder="Input Weight" name="type_bulky">
                                                </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="weight" class="col-3 col-form-label">Weight</label>
                                    <div class="col-9">
                                        <input type="weight" class="form-control" id="weight"
                                               placeholder="Enter Weight"
                                               required value="{{ old('weight') }}" name="weight">
                                    </div>
                                </div>

                                
                                <div class="col-auto"> 

                                    <button type="submit" class="btn btn-primary mb-2"><i class="uil uil-search"></i>
                                        Calculate Price</button>
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