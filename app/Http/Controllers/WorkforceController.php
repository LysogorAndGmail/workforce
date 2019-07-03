<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkforceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Workforce;
use Carbon\Carbon;

class WorkforceController extends Controller
{
    public function index()
    {
        $this->authorize('workforce_read');

        $sessionOrgId = session('selected_org_id');
        $workforces   = Workforce::where('org_id', $sessionOrgId)->get();

        foreach ($workforces as $workforce) {
            $workforce->full_name = $workforce->fname . ' ' . $workforce->lname;
        }

        return response()->json($workforces->load(['jobTitles', 'organization', 'user', 'recruited', 'createdUser']));
    }

    public function onlyWorkforce()
    {
        $this->authorize('workforce_read');

        $sessionOrgId = session('selected_org_id');
        $workforces   = Workforce::where('org_id', $sessionOrgId)->where('is_personnel', 0)->get();

        foreach ($workforces as $workforce) {
                $workforce->full_name = $workforce->fname . ' ' . $workforce->lname;
        }

        return response()->json($workforces->load(['jobTitles', 'organization', 'user', 'recruited', 'createdUser']));
    }

    public function show(Request $request)
    {
        $this->authorize('workforce_read');

        $workforce = Workforce::find($request->workforce);

        $workforce->full_name = $workforce->fname . ' ' . $workforce->lname;

        return response()->json($workforce->load(['jobTitles', 'organization', 'user', 'recruited', 'createdUser']));
    }

    public function store(WorkforceRequest $request)
    {
        $this->authorize('workforce_create');

        $orgId                   = session('selected_org_id');
        $workforce               = new Workforce();
        $workforce->org_id       = $orgId;
        $workforce->job_title_id = $request->job_title_id;
        $workforce->user_id      = $request->user_id;
        $workforce->fname        = $request->fname;
        $workforce->lname        = $request->lname;
        $workforce->gender       = ($request->gender) ? 1 : 0;
        $workforce->idcode       = $request->idcode;
        $workforce->dob          = Carbon::parse($request->dob);
        $workforce->is_personnel = ($request->is_personnel) ? 1 : 0;
        $workforce->phone        = $request->phone;
        $workforce->email        = $request->email;
        $workforce->address      = $request->address;
        $workforce->bank_acc     = $request->bank_acc;
        $workforce->source       = $request->source;
        $workforce->recruited_by = $request->recruited_by;
        $workforce->created_by   = auth()->id();
        $workforce->save();

        $userId = auth()->id();
        info("User id=$userId stored new workforce id=$workforce->id for org_id=$orgId");

        return response()->json(true);
    }

    public function update(WorkforceRequest $request)
    {
        $this->authorize('workforce_update');

        $workforce               = Workforce::find($request->workforce);
        $workforce->job_title_id = $request->job_title_id;
        $workforce->user_id      = $request->user_id;
        $workforce->fname        = $request->fname;
        $workforce->lname        = $request->lname;
        $workforce->gender       = ($request->gender) ? 1 : 0;
        $workforce->idcode       = $request->idcode;
        $workforce->dob          = Carbon::parse($request->dob);
        $workforce->is_personnel = ($request->is_personnel) ? 1 : 0;
        $workforce->phone        = $request->phone;
        $workforce->email        = $request->email;
        $workforce->address      = $request->address;
        $workforce->bank_acc     = $request->bank_acc;
        $workforce->source       = $request->source;
        $workforce->recruited_by = $request->recruited_by;
        $workforce->update();

        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        info("User id=$userId updated workforce id=$workforce->id for org_id=$orgId");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('workforce_destroy');

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        $workforce = Workforce::find($request->workforce);

        info("User id=$userId deleted workforce id=$workforce->id for org_id=$orgId");
        $workforce->delete();

        return response()->json(true);
    }
}
