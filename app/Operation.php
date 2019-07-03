<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use SoftDeletes;

    public function subOperations()
    {
        return $this->hasMany(SubOperation::class, 'operation_id');
    }
}
