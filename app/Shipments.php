<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    protected $table = 'shipments';
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

  
}
