<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use  SoftDeletes;

    protected $table = 'payments';
    protected $guarded = [];

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
