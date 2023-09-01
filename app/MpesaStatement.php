<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MpesaStatement extends Model
{
    protected $table ='C2B';
    protected $fillable=['FirstName', 'MiddleName','MSISDN', 'TransactionType', 'TransactionID','TransactionAmount','InternalReference','CreatedAt'];

}
