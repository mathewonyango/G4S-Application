<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Limits extends Model
{
    protected $table = 'Limit';

    protected $fillable = ['TransactionLimit','ProcessingCode','DailyLimit'];


}
