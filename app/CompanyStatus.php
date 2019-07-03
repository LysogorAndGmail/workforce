<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyStatus extends Model
{
    use SoftDeletes;

    public function org()
    {
        return $this->belongsTo(Organization::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'status_id');
    }
}
