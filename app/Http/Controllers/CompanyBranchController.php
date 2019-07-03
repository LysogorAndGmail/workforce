<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyBranchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Company;
use App\CompanyBranch;

class CompanyBranchController extends Controller
{
    public function companyBranches(Request $request)
    {
        $this->authorize('company_branch_read');

        $branchs = CompanyBranch::where('company_id', $request->company)->get();

        return response()->json($branchs);
    }

    public function show(Request $request)
    {
        $this->authorize('company_branch_read');

        $branch = CompanyBranch::find($request->branch);

        return response()->json($branch->load('contacts'));
    }

    public function store(CompanyBranchRequest $request)
    {
        $this->authorize('company_branch_create');

        $branch             = new CompanyBranch();
        $branch->company_id = $request->company_id;
        $branch->name       = $request->name;
        $branch->address    = $request->address;
        $branch->phone      = $request->phone;
        $branch->email      = $request->email;
        $branch->color      = $request->color;
        $branch->created_by = auth()->id();
        $branch->save();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId stored new company branch id=$branch->id to company id=$branch->company_id for organization_id=$org");

        return response()->json(true);
    }

    public function update(CompanyBranchRequest $request)
    {
        $this->authorize('company_branch_update');

        $branch          = CompanyBranch::find($request->branch);
        $branch->name    = $request->name;
        $branch->address = $request->address;
        $branch->phone   = $request->phone;
        $branch->email   = $request->email;
        $branch->color   = $request->color;
        $branch->update();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId update company branch id=$branch->id for company id=$branch->company_id for organization_id=$org");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('company_branch_destroy');

        $userId = auth()->id();
        $org    = session('selected_org_id');
        $branch = CompanyBranch::find($request->branch);

        info("User id=$userId trying to destroy company branch id=$branch->id for company id=$branch->company_id for organization_id=$org");

        $branch->delete();

        return response()->json(true);
    }
}
