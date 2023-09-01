<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Receipt</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .row {
            margin-left: -5px;
            margin-right: -5px;
        }

        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }
		 .columns {
            float: left;
            width: 30%;
            padding: 10px;
        }

        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        body {
            font-family: 'Courier New', Courier, monospace;
            background-color: #f9f9f9;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            height: auto;
        }

        .company-details {
            text-align: center;
        }

        .section {
            margin-bottom: 10px;
            border: 0.5px solid #ccc;
            padding: 5px;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
        }


        @media print {
            body {
                size: portrait;
                transform: rotate(150deg);
                transform-origin: left top;
                width: 50vw;
                height: 50vh;
                position: absolute;
                overflow: hidden;
                top: 0;
                left: 0;
                margin: 0;
                padding: 0;
            }

            .section {
                width: calc(100% - 40px);
                height: calc(100% - 40px);
                padding: 20px;
            }


        }
    </style>
</head>

<body>
    <div class="logo">
        <img src="data:image/svg+xml;base64,<?php echo base64_encode(file_get_contents(base_path('public/images/G4S.jpg'))); ?>" width="120">
    </div>

    <div class="company-details">
        <div class="company-name">G4S Courier</div>
        <div class="company-address">123 Main Street, Nairobi, Kenya</div>
        <div class="company-contact">Phone: +254 123 456 789 | Email: info@g4scourier.com</div>
    </div>

    <div class="section" style="text-align: center;">
        <div class="section-title">Parcel Receipt</div>
    </div>


    <div class="row">
        <div class="column">
            <table>
                @foreach($parcels as $key => $parcel)
                <tr>
                <th colspan="3" style="background-color: black; color:white; text-align: center;">Parcel Details</th>
                </tr>
                <tr>
                    <th class="vertical-header">Parcel ID</th>
                    <td>{{ $parcel->parcel_id }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">From</th>
                    <td>{{ getRegionName($parcel->from) }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">To</th>
                    <td>{{ getRegionName($parcel->to) }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">Price</th>
                    <td>{{ $parcel->price }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">Quantity</th>
                    <td>{{ $parcel->quantity }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">Weight</th>
                    <td>{{ $parcel->weight }} kg</td>
                </tr>
                <tr>
                    <th class="vertical-header">Collection Date</th>
                    <td>{{ $parcel->created_at }}</td>
                </tr>
                <tr>
                    <th class="vertical-header">Status</th>
                    <td>
                        @if($parcel->status == 1)
                        <span class="status-badge badge-info">Processing</span>
                        @elseif ($parcel->status == 2)
                        <span class="status-badge badge-warning">In Transit</span>
                        @elseif ($parcel->status == 3)
                        <span class="status-badge badge-warning">In Transit</span>
                        @elseif ($parcel->status == 4)
                        <span class="status-badge badge-primary">Pick Up Station</span>
                        @elseif ($parcel->status == 5)
                        <span class="status-badge badge-danger">Delivered</span>
                        @else
                        <span class="status-badge badge-danger">Failed</span>
                        @endif
                    </td>
                    @endforeach
            </table>
        </div>

        <div class="column">
            <table>
                @foreach($parcels as $key => $parcel)
                <tr>
                <th colspan="3" style="background-color: black; color:white; text-align: center;">Sender Details</th>
                </tr>
               
                <tr>
                    <th>Name</th>
                    <td>{{ $parcel->sender }}</td>
                </tr>
                <tr>
                    <th>ID Number</th>
                    <td>{{ $parcel->sender_id }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $parcel->sender_phone }}</td>
                </tr>
            </table>
            <br>

            <table>
                <tr>
                <th colspan="3" style="background-color: black; color:white; text-align: center;">Receiver Details</th>
                </tr>
               
                <tr>
                    <th>Name</th>
                    <td>{{ $parcel->receiver }}</td>
                </tr>
                <tr>
                    <th>ID Number</th>
                    <td>{{ $parcel->receiver_id}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $parcel->receiver_phone }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="column">
            <table>
                @foreach($parcels as $key => $parcel)
                <tr>
                <th colspan="3" style="background-color: black; color:white; text-align: center;">Delivery Person Details</th>
                </tr>
                <tr>
                    <th class="vertical-header">Name</th>
                    @if($parcel->rider == null)
                            <td>Not Assigned</td>
                            @else
                        <td>{{getRiderName($parcel->rider)}}</td>
                            @endif
                </tr>
                <tr>
                    <th class="vertical-header">ID Number</th>
                    @if($parcel->rider == null)
                            <td>Not Assigned</td>
                            @else
                        <td>{{getRiderId($parcel->rider)->idnumber}}</td>
                            @endif
                </tr>
                <tr>
                    <th>Phone</th>
                    @if($parcel->rider == null)
                            <td>Not Assigned</td>
                            @else
                        <td>{{getRiderId($parcel->rider)->phonenumber}}</td>
                            @endif
                </tr>
                <tr>
                    <th class="vertical-header">Signature</th>
                    <td>-------------</td>
                </tr>
            </table>
        </div>
        <div class="column">
            <table>
                <tr>
                <th colspan="3" style="background-color: black; color:white; text-align: center;">G4S Employee Details</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{getMakerName($parcel->maker)}}</td>
                </tr>
                <tr>
                    <th>ID Number</th>
                    <td>{{getUserdetails($parcel->maker)->idnumber}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{getUserdetails($parcel->maker)->phonenumber}}</td>
                </tr>
                <tr>
                    <th class="vertical-header">Signature</th>
                    <td>-------------</td>
                </tr>
                @endforeach
            </table>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            <table>
                <tr>
                <th colspan="2" style="background-color: black; color:white; text-align: center;">Receiver ID</th>
                </tr>
                <tr>
                   
                    @if($parcel->id_img == null)
                            <td>Not Delivered</td>
                            @else
                         <td>
							<img src="data:image/png;base64,<?php echo $parcel->id_img; ?>"width="100px" height="75px">
                        </td>
					@endif
                </tr>
            </table>
        </div>
        <div class="columns">
            <table>
                <tr>
                <th colspan="2" style="background-color: black; color:white; text-align: center;">Receiver Signature</th>
                </tr>
                <tr>
                   
                    @if($parcel->signature_img == null)
                            <td>Not Delivered</td>
                            @else
                        <td><img src="data:image/png;base64,<?php echo $parcel->signature_img; ?>"width="100px" height="75px"></td>
                       
                            @endif
                </tr>
    
                @endforeach
            </table>
            <br>
        </div>
		 <div class="columns">
            <table>
                <tr>
                <th colspan="2" style="background-color: black; color:white; text-align: center;">Weigh bill</th>
                </tr>
                <tr>
                   
                    @if($parcel->waybill_image == null)
                            <td>Not Delivered</td>
                            @else
                         <td>
							<img src="data:image/png;base64,<?php echo $parcel->waybill_image; ?>"width="100px" height="75px">
                        </td>
					@endif
                </tr>
            </table>
        </div>
    </div>

</body>

</html>