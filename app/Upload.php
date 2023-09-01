<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';
    protected $guarded = [];

    public static $checker_stage = 'checker-approval';
    public static $transmitter_stage = 'transmission-approval';
    public static $checker_label = 'Checker';
    public static $transmitter_label = 'Transmission';

    public function scopeChecker($query)
    {
        $query->where('stage', self::$checker_stage);
    }

    public function scopeTransmitter($query)
    {
        $query->where('stage', self::$transmitter_stage);
    }


    public function events()
    {
        return $this->hasMany(Timeline::class, 'upload_id');
    }

    public function uploadable()
    {
        return $this->morphTo();
    }

    public function getRouteKey()
    {
        return $this->uuid;
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }


    public function getPaymentsCountAttribute()
    {
        return $this->payments()->count();
    }


    public function getStageTextAttribute()
    {
        return str_slug_reverse($this->stage, '-');
    }


    public function maker()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getStageLabelAttribute()
    {
        $current_stage = $this->stage;
        $label = '';
        if ($current_stage === self::$checker_stage) {
            $label = self::$checker_label;
        } elseif ($current_stage === self::$transmitter_stage) {

            $label = self::$transmitter_label;
        }
        return $label;
    }

    public function getBtnTypeAttribute()
    {
        $current_stage = $this->stage;
        $label = '';
        if ($current_stage === self::$checker_stage) {
            $label = 'primary';
        } elseif ($current_stage === self::$transmitter_stage) {

            $label = 'darker';
        }

        return $label;
    }

    public function getApprovalPhraseAttribute()
    {
        $current_stage = $this->stage;
        $label = '';
        if ($current_stage === self::$checker_stage) {
            $label = 'The task will the move to the transmitter for approval';
        } elseif ($current_stage === self::$transmitter_stage) {

            $label = 'The funds will be transferred to respective phone numbers';
        }

        return $label;
    }
}
