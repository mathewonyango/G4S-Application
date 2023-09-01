<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parcel Receipt</title>
    <style>
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
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-content {
            margin-left: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: black;
            color: white;
        }

        @media print {
            body {
                transform: rotate(270deg);
                transform-origin: left top;
                width: 100vw;
                height: 100vh;
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
    <style>
    /* ... Existing CSS styles ... */

    .status-badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
    }

    /* .badge-info {
        background-color: #17a2b8;
        color: #fff;
    } */

    .badge-warning {
        background-color: #ffc107;
        color: #000;
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


    <div class="section">
        <!-- <div class="section-title">Parcel Details</div> -->
        <div class="section-content">
        <table>
                <thead>
                    <tr>
                        <th class="vertical-header">Parcel ID</th>
                        <th class="vertical-header">From</th>
                        <th class="vertical-header">To</th>
                        <th class="vertical-header">Price</th>
                        <th class="vertical-header">Sender</th>
                        <th class="vertical-header">Receiver</th>
                        <th class="vertical-header">Date</th>
                       
                        <th class="vertical-header">Status</th>
                        <th class="vertical-header">Variance</th>

                    </tr>




                </thead>
                <tbody>
                    @foreach($parcels as $key => $parcel)
                    <tr>
                        <td>{{ $parcel->parcel_id }}</td>
                        <td>{{ getRegionName($parcel->from) }}</td>
                        <td>{{ getRegionName($parcel->to) }}</td>
                        <td>{{ $parcel->price }}</td>
                    
                        <td>{{ $parcel->sender }}</td>
                        <td>{{ $parcel->receiver }}</td>
                        <td>{{ $parcel->created_at }}</td>
                       

                        <td>
    @if($parcel->status == 1)
    <span class="status-badge badge-info" style="color: blue;">Processing</span>
    @elseif ($parcel->status == 2)
    <span class="status-badge badge-info" style="color: blue;">Dispatch</span>
    @elseif ($parcel->status == 3)
    <span class="status-badge badge-warning" style="color: orange;">In Transit</span>
    @elseif ($parcel->status == 4)
    <span class="status-badge badge-primary" style="color: purple;">Pick Up Station</span>
    @elseif ($parcel->status == 5)
    <span class="status-badge badge-success" style="color: green;">Delivered</span>
    @else
    <span class="status-badge badge-danger" style="color: red;">Failed</span>
    @endif
</td>
<td>{{variance($parcel->id)}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   
        
    </div>
</div>



</body>
</html>
