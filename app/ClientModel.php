<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ClientModel extends Model
{
   protected $table = 'client';
   protected $fillable = ['client_id', 'fullname','phone_number', 'email', ' is_active','client_type','corporate_id','created_at'];
}

