<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Organization;
use App\Role;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $this->authorize('user_read');

        $org   = Organization::with('users')->find(session('selected_org_id'));
        $users = $org->users;

        //TODO: check if correct org roles are showing when user has multiple orgs and roles

        return response()->json($users->load(['roles', 'workforce', 'country']));
    }

    public function show(Request $request)
    {
        $this->authorize('user_read');
        $orgId = session('selected_org_id');

        $user = User::find($request->user);
        $user->load(['roles', 'workforce', 'country']);

        $roles = $user->roles->filter(function ($role) use ($orgId) {
            if ($role->org_id == $orgId) {
                return true;
            }

            return false;
        });

        return response()->json(['user' => $user, 'roles' => $roles]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('user_create');
        $orgId = session('selected_org_id');

        $accountRes = $this->storeInAccount($request, $orgId);

        $user = new User([
            'id'         => $accountRes->id,
            'country_id' => $request->country_id,
            'fname'      => $accountRes->fname,
            'lname'      => $accountRes->lname,
            'email'      => $accountRes->email,
            'password'   => Hash::make('secret'),
        ]);
        $user->save();
        info("User id=$user->id created to WORKFORCE for org id=$orgId");

        // attaching org
        $org = Organization::find($orgId);
        $org->users()->attach($user->id);
        info("User id=$user->id attached to org id=$orgId");

        // attaching role
        $user->roles()->attach($request->role, [
            'org_id' => $orgId
        ]);
        info("User id=$user->id attached to role id=$request->role");

        return response()->json(true);
    }

    protected function storeInAccount($request, $orgId)
    {
        $token = session('account_token');

        $client = new Client();

        info("Sendig request to ACCOUNT to create a user for org id=$orgId with token=$token");

        $url = env('ACCOUNT_URL');
        $res = $client->request('POST', "$url/api/workforce/user/create", [
            'json' => [
                'access_token' => $token,
                'org_id'       => $orgId,
                'fname'        => $request->fname,
                'lname'        => $request->lname,
                'email'        => $request->email,
            ]
        ]);

        $accountRes = json_decode($res->getBody()->getContents());
        info("User created to ACCOUNT for org id=$orgId with token=$token");

        return $accountRes;
    }

    public function update(UserRequest $request)
    {
        $this->authorize('user_update');
        $orgId = session('selected_org_id');

        $user             = User::find($request->user);
        $user->country_id = $request->country_id;
        $user->fname      = $request->fname;
        $user->lname      = $request->lname;
        $user->email      = $request->email;
        $user->update();

        // remove role
        foreach ($user->roles as $role) {
            if ($role->org_id == $orgId) {
                $user->roles()->detach($request->role);
            }
        }

        // attaching role
        $user->roles()->attach($request->role, [
            'org_id' => $orgId
        ]);

        $this->updateInAccount($request, $orgId);

        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        info("User id=$userId updated user id=$user->id for org_id=$orgId");

        return response()->json(true);
    }

    protected function updateInAccount($request, $orgId)
    {
        $token = session('account_token');

        $client = new Client();

        info("Sendig request to ACCOUNT to update a user for org id=$orgId with token=$token");

        $url = env('ACCOUNT_URL');
        $res = $client->request('PUT', "$url/api/workforce/user/update", [
            'json' => [
                'access_token' => $token,
                'id'           => $request->user,
                'fname'        => $request->fname,
                'lname'        => $request->lname,
                'email'        => $request->email,
            ]
        ]);

        $accountRes = json_decode($res->getBody()->getContents());
        info("User updated in ACCOUNT for org id=$orgId with token=$token");

        return $accountRes;
    }

    public function destroy(Request $request)
    {
        $this->authorize('user_destroy');

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        if ($userId == $request->user) {
            return response()->json('cannot_delete_yourself', Response::HTTP_CONFLICT);
        }

        $user = User::find($request->user);

        $this->destroyInAccount($request, $orgId);

        foreach ($user->roles as $role) {
            if ($role->org_id == $orgId) {
                info("User id=$user->id role id=$role->id deleted by user id=$userId from org id=$orgId");
                $user->roles()->detach($role->id);
            }
        }

        foreach ($user->orgs as $org) {
            if ($org->id == $orgId) {
                info("User id=$user->id removed from org id=$org->id by user id=$userId from org id=$orgId");
                $user->orgs()->detach($org->id);
            }
        }

        info("User id=$userId deleted user id=$user->id for org_id=$orgId");
        $user->delete();

        return response()->json(true);
    }

    protected function destroyInAccount($request, $orgId)
    {
        $token = session('account_token');

        $client = new Client();

        info("Sendig request to ACCOUNT to delete a user for org id=$orgId with token=$token");

        $url = env('ACCOUNT_URL');
        $res = $client->request('DELETE', "$url/api/workforce/user/destroy", [
            'json' => [
                'access_token' => $token,
                'id'           => $request->user,
                'org_id'       => $orgId
            ]
        ]);

        $accountRes = json_decode($res->getBody()->getContents());
        info("User deleted in ACCOUNT for org id=$orgId with token=$token");

        return $accountRes;
    }
}
