<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripModel extends Model

    {
        protected $table ='trip';
        protected $fillable = ['pickup_address', 'dropoff_address', 'type_of_trip ', 'trip_cost ','started_time','end_time','payment_type','delivery_date','reciever_name','reciever_phone','trip_code','created_at','paid'];
    
    }
    
