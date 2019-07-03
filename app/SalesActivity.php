<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesActivity extends Model
{
    use SoftDeletes;
    
    public function contacts()
    {
        return $this->belongsToMany(CompanyContact::class, 'sales_activity_contacts', 'activity_id', 'contact_id')->withTimestamps();
    }
    
    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type()
    {
        return $this->belongsTo(SalesActivityType::class, 'type_id');
    }

}
