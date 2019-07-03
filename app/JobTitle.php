<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(JobTitleCategory::class, 'category_id');
    }
}
