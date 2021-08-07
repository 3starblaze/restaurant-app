<?php

namespace App\Misc;

use Illuminate\Support\Str;

trait UsesUuid {
    protected static function boot() {
        parent::boot();

        static::creating(function  ($model)  {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getKeyType() {
        return 'string';
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
