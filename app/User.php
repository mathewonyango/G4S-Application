<?php

namespace App;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, softDeletes, LogsActivity, CanResetPassword, CausesActivity;

    protected $table = 'users';
    protected $guarded = [];
    protected $logUnguarded = true;

    protected static $logOnlyDirty = true;

//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
   protected $fillable = [
   'employee_number',
   'region_code',
    'firstname',
    'lastname',
    'email',
    'username',
    'phonenumber',
    'idnumber',
    'password',
    'dateofbirth',
    'active',
    'status',
    'branch_id',
    'address',
    'username',
    'type', 'corporate_id'
   ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //BELONGS TO

    public function branch()
{
    return $this->belongsTo(Branch::class);
}

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = (empty($value) || strlen($value) > 58) ? $value : bcrypt($value);
    }

    public function getAccountName()
    {
        return $this->name;
    }

    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first();
    }

    public function getRouteKey()
    {
        return $this->uuid;
    }
}
