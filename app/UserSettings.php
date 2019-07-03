<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSettings extends Eloquent
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
