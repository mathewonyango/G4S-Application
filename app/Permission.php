<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|Permission|null
     */
    public static function getByName($name)
    {
        return self::query()->where('name', $name)->first();
    }
}
