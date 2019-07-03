<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSchedule extends Model
{
    use SoftDeletes;

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function workDays()
    {
        return $this->hasMany(Workday::class, 'work_schedule_id');
    }

    public function workforces()
    {
        return $this->belongsToMany(Workforce::class, 'work_schedule_workforces', 'work_schedule_id', 'workforce_id');
    }
}
