<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_name', 'group_number', 'group_type', 'created_by', 'verified_by' ];
}
