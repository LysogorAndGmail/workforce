<?php

namespace App\Http\Controllers;

use App\Role;
use App\Organization;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $this->authorize('role_read');

        $roles = Role::where('org_id', session('selected_org_id'))->get();

        return response()->json($roles->load(['org', 'permissions']));
    }

    public function show(Request $request)
    {
        $this->authorize('role_read');

        $role = Role::find($request->role);

        return response()->json($role);
    }

    public function store(RoleRequest $request)
    {
        $this->authorize('role_create');

        $org = session('selected_org_id');

        $role               = new Role();
        $role->org_id       = $org;
        $role->display_name = $request->name;
        $role->name         = Str::slug($request->name, '_');
        $role->created_by   = auth()->id();
        $role->save();

        $userId = auth()->id();

        info("User id=$userId stored new role id=$role->id to organization id=$org");

        return response()->json(true);
    }

    public function update(RoleRequest $request)
    {
        $this->authorize('role_update');

        $role               = Role::find($request->role);
        $role->display_name = $request->name;
        $role->name         = Str::slug($request->name, '_');
        $role->update();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId update role id=$role->id for organization id=$org");

        return response()->json(true);
    }

    public function togglePermission(Request $request)
    {
        $this->authorize('role_update');

        $userId  = auth()->id();
        $org     = session('selected_org_id');
        $role    = Role::find($request->role);
        $message = 'permission_added';

        if ($role->permissions->contains($request->permission)) {
            $permission = Permission::find($request->permission);

            if ($permission->name == 'role_update' && $request->role == session('selected_role_id')) {
                $message = 'cannot_remove_permission';

                return response()->json(['message' => $message], Response::HTTP_CONFLICT);
            } else {
                $role->permissions()->detach($request->permission);
                info("User id=$userId trying to remove permission role_id=$request->role and permission_id=$request->permission for organization id=$org");
                $message = 'permission_removed';

                return response()->json(['message' => $message]);
            }

        } else {
            $role->permissions()->attach($request->permission);
            info("User id=$userId trying to add permission role_id=$request->role and permission_id=$request->permission for organization id=$org");

            return response()->json(['message' => $message]);
        }
    }

    public function destroy(Request $request)
    {
        $this->authorize('role_destroy');

        $org = session('selected_org_id');

        $userRoles = DB::table('user_roles')->where([
            ['org_id', '=', $org],
            ['role_id', '=', $request->role]
        ])->get();

        if ($userRoles->count() == 0) {

            $userId = auth()->id();

            info("User id=$userId trying to destroy role id=$request->role for organization id=$org");
            $role = Role::find($request->role);
            $role->permissions()->detach();
            $role->delete();

            return response()->json(true);
        } else {
            return response()->json([
                'message' => 'cannot_delete_roles_has_users'
            ], Response::HTTP_CONFLICT);
        }
    }
}
