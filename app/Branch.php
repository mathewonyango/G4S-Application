<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
    protected $guarded;

    protected $fillable = [
       'names', 'code', 'maker', 'checker',
    ];

    public function user()
{
    return $this->hasOne(User::class);
}

}
