<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesActivityType extends Model
{
    use SoftDeletes;

    protected $casts = [
        'roles' => 'array'
    ];

    public function activity()
    {
        return $this->belongsTo(SalesActivity::class, 'type_id');
    }

}