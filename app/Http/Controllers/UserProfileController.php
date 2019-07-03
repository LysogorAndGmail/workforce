<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function user()
    {
        return response()->json(auth()->user()->load('country'));
    }

    public function userPermissions()
    {
        $permissions     = [];
        $role            = Role::with('permissions')->find(session('selected_role_id'));
        $rolePermissions = $role->permissions->makeHidden([
            'id',
            'display_name',
            'pivot',
            'updated_at',
            'created_at',
        ]);
        foreach ($rolePermissions as $perm) {
            $permissions[] = $perm->name;
        }

        return response()->json($permissions);
    }
}
