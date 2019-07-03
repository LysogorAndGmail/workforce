<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrgController extends Controller
{
    public function orgUsers()
    {
        $sessionOrgId = session('selected_org_id');
        $org          = Organization::find($sessionOrgId);
        $org->load('users');
        $users = $org->users;

        foreach ($users as $user) {
            $user->full_name = $user->fname . ' ' . $user->lname;
        }

        return response()->json($users->load('workforce'));
    }
}
