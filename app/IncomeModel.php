<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeModel extends Model
{
    protected $table ='C2B';
    protected $fillable =['FirstName', 'MiddleName','MSISDN', 'TransactionType', 'TransactionID','TransactionAmount','BusinessShortCode','CreatedAt'];
}
