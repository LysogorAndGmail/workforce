<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyContact extends Model
{
    use SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function companyBranch()
    {
    	return $this->belongsTo(CompanyBranch::class, 'branch_id');
    }
    
    public function salesActivityContacts()
    {
        return $this->belongsToMany(SalesActivity::class, 'sales_activity_contacts ', 'contact_id', 'activity_id')->withTimestamps();
    }
}
