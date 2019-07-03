<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workday extends Model
{
    use SoftDeletes;

    public function workSchedule()
    {
        return $this->belongsTo(WorkSchedule::class, 'work_schedule_id');
    }

    public function workForce()
    {
        return $this->belongsTo(Workforce::class, 'workforce_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
