<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubOperation extends Model
{
    use SoftDeletes;

    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id');
    }
}
