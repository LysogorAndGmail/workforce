<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return response()->json($permissions);
    }
}
