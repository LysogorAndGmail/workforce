<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'org_id',
        'name',
        'display_name',
        'created_by'
    ];

    public function org()
    {
        return $this->belongsTo(Organization::class, 'org_id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions')->withTimestamps();
    }
}
