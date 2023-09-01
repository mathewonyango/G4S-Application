<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $guarded;

    protected $fillable = [
        'name', 'longitude', 'latitude', 'address'
     ];

}
