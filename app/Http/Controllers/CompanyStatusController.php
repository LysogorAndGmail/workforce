<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStatusRequest;
use Illuminate\Http\Request;
use App\CompanyStatus;

class CompanyStatusController extends Controller
{
    public function index()
    {
        $this->authorize('company_status_read');

        $sessionOrgId = session('selected_org_id');
        $statuses     = CompanyStatus::where('org_id', $sessionOrgId)->get();

        return response()->json($statuses->load('org'));
    }

    public function show(Request $request)
    {
        $this->authorize('company_status_read');

        $status = CompanyStatus::find($request->status);

        return response()->json($status);
    }

    public function store(CompanyStatusRequest $request)
    {
        $this->authorize('company_status_create');

        $userId = auth()->id();
        $org    = session('selected_org_id');

        $status         = new CompanyStatus();
        $status->org_id = $org;
        $status->name   = $request->name;
        $status->color  = $request->color;
        $status->reason = $request->reason;
        $status->save();


        info("User id=$userId stored new company status id=$status->id for organization_id=$org");

        return response()->json(true);
    }

    public function update(CompanyStatusRequest $request)
    {
        $this->authorize('company_status_update');

        $userId         = auth()->id();
        $org            = session('selected_org_id');

        $status         = CompanyStatus::find($request->status);
        $status->name   = $request->name;
        $status->color  = $request->color;
        $status->reason = $request->reason;
        $status->update();

        info("User id=$userId update company status id=$status->id for organization_id=$org");

        return response()->json(true);
    }

    public function destroy(CompanyStatus $status)
    {
        $this->authorize('company_status_destroy');

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId delete company status id=$status->id for organization_id=$org");

        $status->delete();

        return response()->json(true);
    }
}