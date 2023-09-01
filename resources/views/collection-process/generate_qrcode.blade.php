@extends('layout.default')

@section('breadcrumb')
<div class="row page-title">
    <div class="col-md-12">
        <nav aria-label="breadcrumb" class="float-right mt-1">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Parcel</a></li>
                <!-- <li class="breadcrumb-item"><a href="">Transactions</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Parcel management Management</li>
            </ol>
        </nav>
        <h4 class="mb-1 mt-0">Generate QR Code</h4>
    </div>
</div>
@endsection

@section('content')
<style>
    body #coupon {
  display: none;
}
@media print {
  body * {
    display: none;
  }
  body #coupon {
    display: block;
  }
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        {{-- <h4 class="header-title mt-0 mb-1">New User</h4> --}}
                    </div>
                    <!-- <div class="col-lg-6">
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary float-right" rel="tooltip"
                                data-placement="top" title="Back to Listing">
                                <i class="uil uil-arrow-left"> Back Home</i>
                            </a>
                        </div> -->
                </div>
                <br>

                <div class="row">
                    <div class="col-xl-10">

                        <h1>QR Code Generator</h1>


                        <img src="data:image/png;base64,{{ $barcode }}" id="qrCodeImage" style="width:200;height:200px;" alt="Barcode"> <br><br>


                        <div class="col-auto">
                                    <button  class="btn btn-info mb-2" onclick="printImage()"><i class="uil uil-print"></i>Print QR Code</button>
                                </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@section('script')



<script>
function printImage() {
    var qrCodeImage = document.getElementById('qrCodeImage');
    var printWindow = window.open('', '_blank');

    printWindow.document.write('<html><head><title>Parcel QR Code</title></head><body><img src="' + qrCodeImage.src + '"></body></html>');
    printWindow.document.close();
    printWindow.print();
}
</script>

<script>
        // Initiates the print dialog when the image is loaded
        function () {
            var qrCodeImage = document.getElementById('qr-code');
            qrCodeImage.onload = function() {
                window.print();
            };
        };
    </script>

<script>
    $("button").on("click", function() {
  $("#coupon").off("load").on("load", function() {
    window.print();
  }).attr("src", "http://www.cdc.gov/animalimportation/images/dog2.jpg");
});
</script>
@endsection