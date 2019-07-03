<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\SalesActivityRequest;
use App\SalesActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesActivityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('sales_activity_read');
        
        $company = Company::find($request->company);
        
        $activities = SalesActivity::where('company_id', $company->id)->get();
        
        return response()->json($activities);
    }
    
    public function store(SalesActivityRequest $request)
    {
        $this->authorize('sales_activity_create');
        
        $activity             = new SalesActivity();
        $activity->company_id = $request->company_id;
        $activity->type_id    = $request->type;
        $activity->start_date = Carbon::parse($request->start_date);
        $activity->end_date   = Carbon::parse($request->end_date);
        $activity->address    = $request->address;
        $activity->info       = $request->info;
        $activity->result     = $request->result;
        $activity->outcome    = $request->outcome;
        $activity->created_by = auth()->id();
        $activity->save();
        
        $activity->contacts()->attach($request->contacts);
        
        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        
        info("User id=$userId stored new sales activity id=$activity->id for org id=$orgId");
        
        return response()->json(true);
    }
    
    public function update(SalesActivity $activity, SalesActivityRequest $request)
    {
        $this->authorize('sales_activity_update');
        
        $activity->type_id    = $request->type_id;
        $activity->start_date = Carbon::parse($request->start_date);
        $activity->end_date   = Carbon::parse($request->end_date);
        $activity->address    = $request->address;
        $activity->info       = $request->info;
        $activity->result     = $request->result;
        $activity->outcome    = $request->outcome;
        $activity->created_by = auth()->id();
        $activity->update();
        
        $activity->contacts()->sync($request->contacts);
        
        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        
        info("User id=$userId update sales activity id=$activity->id for org id=$orgId");
        
        return response()->json(true);
    }
    
    public function show(SalesActivity $activity)
    {
        $this->authorize('sales_activity_read');
        
        return response()->json($activity);
    }
    
    public function destroy(SalesActivity $activity)
    {
        $this->authorize('sales_activity_destroy');
        
        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        
        info("User id=$userId deleted sales activity id=$activity->id for org id=$orgId");
        
        $activity->delete();
        
        return response()->json(true);
    }
}
