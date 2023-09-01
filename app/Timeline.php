<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeline extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $table = 'timeline';

    public function getActionAttribute()
    {
        return $this->title;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
