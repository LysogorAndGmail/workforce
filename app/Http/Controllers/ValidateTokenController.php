<?php

namespace App\Http\Controllers;

use App\Organization;
use App\OrgSettings;
use App\Permission;
use App\Role;
use App\User;
use App\UserSettings;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ValidateTokenController extends Controller
{
    public function validateToken(Request $request)
    {
        info("Starting to send token to account for validation");
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $request->access_token,
                'Accept' => 'application/json'
            ]
        ]);
        
        $url = env('ACCOUNT_TOKEN_VALIDATOR_URL');
        
        info("WORKFORCE trying to validate access_token=$request->access_token");
        
        $res = $client->request('POST', $url, [
            'json' => ['access_token' => $request->access_token]
        ]);
        
        $accountRes = json_decode($res->getBody()->getContents());
        
        info("User with account_id=$accountRes->user_id trying to log in to WORKFORCE");
        
        if ($request->user_create) {
            return response()->json($accountRes);
        }
        
        if ($accountRes->user_id) {
            
            Auth::loginUsingId($accountRes->user_id);
            
            $userFirstOrg = auth()->user()->orgs()->first();
            if ($userFirstOrg) {
                $organizatinRoles = auth()->user()->roles->where('org_id', $userFirstOrg->id);
                $orgFirstRole = $organizatinRoles->first();
                
                session(['selected_role_id' => $orgFirstRole->id]);
                session(['selected_org_id' => $userFirstOrg->id]);
                session(['account_token' => $request->access_token]);
                session(['app_locale' => 'en']);
            }
            
            info("User with account_id=$accountRes->user_id logged in to WORKFORCE");
            
            return redirect('/auth');
        } else {
            return response()->json(['message' => 'User does not exist'], 401);
        }
    }
    
    public function createUser(Request $request)
    {
        info("Request to create user from ACCOUNT");
        info("With token = $request->token");
        info("org_id = $request->org_id");
        info("user_id = $request->user_id");
        info("fname = $request->fname");
        info("lname = $request->lname");
        info("email = $request->email");
        
        $userOrg = json_decode($request->org);
        info($request->org);
        
        $validateToken = Request::create('/api/token/validate', 'GET', [
            'access_token' => $request->token,
            'user_create' => true
        ]);
        $response = app()->handle($validateToken);
        
        if ($response->getStatusCode() != 200) {
            return response()->json(['message' => 'Unauthorized, token validation failed'], 401);
        }
        
        $data = json_decode($response->getContent());
        
        if (!$data->granted) {
            return response()->json(['message' => 'Unauthorized, grant not given'], 401);
        }
        
        info('Trying to find user');
        $userExists = User::find($request->user_id);
        if ($userExists) {
            info("User found id=$userExists->id");
        }
        
        info('Trying to find org');
        $orgExists = Organization::find($request->org_id);
        if ($orgExists) {
            info("Org found id=$orgExists->id");
        }
        
        if (!$userExists) {
            
            info('------------------------------------------');
            info('Creating user with');
            info("user_id = $request->user_id");
            info("fname = $request->fname");
            info("lname = $request->lname");
            info("email = $request->email");
            info('------------------------------------------');
            
            $user = new User();
            $user->id = $request->user_id;
            $user->fname = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->password = Hash::make('secret');
            $user->save();
            
            $user_settings = new UserSettings();
            $user_settings->user_id = $user->id;
            $user_settings->zero_sales_act_companies = 5;
            $user_settings->save();
            
        } else {
            $user = $userExists;
        }
        
        if (!$orgExists) {
            
            info('------------------------------------------');
            info('Creating org with');
            info("org_id = $userOrg->id");
            info("name = $userOrg->name");
            info("address = $userOrg->address");
            info("phone = $userOrg->phone");
            info("email = $userOrg->email");
            info("reg = $userOrg->reg");
            info("vat = $userOrg->vat");
            info('------------------------------------------');
            
            $org = new Organization();
            $org->id = $userOrg->id;
            $org->name = $userOrg->name;
            $org->address = $userOrg->address;
            $org->phone = $userOrg->phone;
            $org->email = $userOrg->email;
            $org->reg = $userOrg->reg;
            $org->vat = $userOrg->vat;
            $org->save();
            
            $orgSettings = new OrgSettings();
            $orgSettings->org_id = $org->id;
            $orgSettings->status_length_days = 30;
            $orgSettings->save();
        } else {
            $org = $orgExists;
        }
        
        if (!$org->users()->exists($user->id)) {
            info('------------------------------------------');
            info('Attaching user to org');
            info("org_id = $org->id");
            info("user_id = $user->id");
            info('------------------------------------------');
            $org->users()->attach($user->id);
            info('Attached');
        }
        
        if (!$org->roles()->count() > 0) {
            $role = new Role();
            $role->org_id = $org->id;
            $role->name = 'manager';
            $role->display_name = 'Manager';
            $role->save();
            
            info("Attaching role id=$role->id for user id=$user->id");
            $user->roles()->attach($role->id, ['org_id' => $org->id]);
            info('Role attached');
            info('------------------------------------------');
            info('Created role for org and attached to user');
            info("user_id = $user->id");
            info("role_id = $role->id");
            info("org_id = $org->id");
            info("name = manager");
            info("display_name = Manager");
            info('------------------------------------------');
            
        } else {
            $user->roles()->attach($org->roles()->first()->id, ['org_id' => $org->id]);
            
            info('------------------------------------------');
            info('Org has role, attachind role to user');
            info("org_id = $org->id");
            info("user_id = $user->id");
            info("role_id = {$org->roles()->first()->id}");
            info('------------------------------------------');
        }
        
        $role = $user->roles()->first();
        $role->permissions()->attach(Permission::all()->pluck('id'));
        
        return response()->json(['message' => 'Created']);
    }
    
    public function loginToAccount(Request $request)
    {
        $token = session('account_token');
        
        $client = new Client();
        
        $accountUrl = env('ACCOUNT_URL');
        
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ]
        ]);
        
        $url = env('ACCOUNT_TOKEN_VALIDATOR_URL');
        
        $res = $client->request('POST', $url, [
            'json' => ['access_token' => $token]
        ]);
        
        $decodeRes = json_decode($res->getBody()->getContents());
        
        $userId = auth()->id();
        
        info("User ID = $userId trying Login to Account token=$token");
        
        if (isset($decodeRes->granted) && $decodeRes->granted === true) {
            return response()->json(['url' => $accountUrl . '/auth/dashboard']);
        }
        
    }
}
