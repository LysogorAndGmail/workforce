<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function userRoles(Request $request)
    {
        $org  = Organization::find($request->org);
        $user = auth()->user();

        if (empty(session('selected_org_id'))) {
            session(['selected_org_id' => $user->orgs()->first()->id]);
        }

        $orgId = session('selected_org_id');

        $organizatinRoles = $user->roles->where('org_id', $orgId)->makeHidden([
            'name',
            'org_id',
            'updated_at',
            'created_at',
            'pivot'
        ]);

        if ($organizatinRoles->count() == 1) {
            $roles = [];
            array_push($roles, $organizatinRoles->first());
            $organizatinRoles = $roles;
        }

        session(['selected_role_id' => $organizatinRoles[0]->id]);

        return response()->json($organizatinRoles);
    }

    public function changeRole(Request $request)
    {
        if ( ! auth()->user()->roles->contains($request->role)) {
            return response()->json(['message' => 'Not your Role'], 422);
        }

        session(['selected_role_id' => $request->role]);

        return response()->json(true);
    }

    public function sessionRole()
    {
        return response()->json(session('selected_role_id'));
    }
}
