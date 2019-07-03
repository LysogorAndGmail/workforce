<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrgSettings extends Model
{
    use SoftDeletes;
    
    public function orgs()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }
    
    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
