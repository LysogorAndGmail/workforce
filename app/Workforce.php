<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workforce extends Model
{
     use SoftDeletes;

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recruited()
    {
        return $this->belongsTo(User::class, 'recruited_by');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jobTitles()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function workDays()
    {
        return $this->hasMany(Workday::class, 'workforce_id');
    }
}
