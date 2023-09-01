<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'message', 'subject', 'created_at'
    ];
    protected $table = 'mssg_web';
}
