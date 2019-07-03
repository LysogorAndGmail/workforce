<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitleCategory extends Model
{
    use SoftDeletes;

    public function jobTitles()
    {
        return $this->hasMany(JobTitle::class, 'category_id');
    }
}
