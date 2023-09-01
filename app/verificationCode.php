<?php

namespace App;

use App\Traits\BelongsToUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verificationCode extends Model
{
    use softDeletes, BelongsToUser;

    protected $guarded = [];

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', Carbon::now());
    }

    public function scopeValid($query)
    {
        return $query->where('expires_at', '<', Carbon::now());
    }
}
