<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corporate extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact_person',
        'address',
        'phonenumber',
        'corporate_id'
    ];
//    protected $primaryKey = 'corporate_id';
}
