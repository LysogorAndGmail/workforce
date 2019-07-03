<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    public function companies()
    {
        return $this->hasMany(Company::class, 'country_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
