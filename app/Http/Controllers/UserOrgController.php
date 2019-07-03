<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrgController extends Controller
{
    public function userOrgs()
    {
        $clearOrgs = [];
        $allOrgs   = auth()->user()->orgs->makeHidden([
            'address',
            'phone',
            'email',
            'reg',
            'vat',
            'updated_at',
            'created_at',
            'pivot'
        ]);

        foreach ($allOrgs as $org) {
            if ($this->checkOrganization($clearOrgs, $org)) {
                $clearOrgs[] = $org;
            }
        }

        return response()->json($clearOrgs);
    }

    protected function checkOrganization($clearOrgs, $org)
    {
        $check = true;
        foreach ($clearOrgs as $orgs) {
            if ($orgs->id == $org->id) {
                $check = false;
            }
        }

        return $check;
    }

    public function sessionOrg()
    {
        return response()->json(session('selected_org_id'));
    }

    public function changeOrg(Request $request)
    {
        if ( ! auth()->user()->orgs->contains($request->org)) {
            return response()->json(['message' => 'Not your Organization'], 422);
        }

        $organizatinRoles = auth()->user()->roles->where('org_id', $request->org);
        $orgFirstRole     = $organizatinRoles->first();

        session(['selected_org_id' => $request->org]);
        session(['selected_role_id' => $orgFirstRole->id]);

        return response()->json(true);
    }
}
