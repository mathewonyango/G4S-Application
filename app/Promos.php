<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promos extends Model
{
    protected $table = 'promotions';
    protected $fillable = [
        'promo_code', 'amount', 'applies_to', 'expiry','applicable_times','start_date', 'status', 'name'
    ];
}
