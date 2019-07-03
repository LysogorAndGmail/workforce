<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkScheduleRequest;
use App\WorkSchedule;


class WorkScheduleController extends Controller
{
    public function index()
    {
        $this->authorize('workschedule_read');

        $workschedules = WorkSchedule::where('org_id', session('selected_org_id'))->get();

        return response()->json($workschedules->load(['org','company']));
    }

    public function companyWorkSchedules(Request $request)
    {
        $this->authorize('workschedule_read');

        $workschedules = WorkSchedule::where('company_id', $request->company)->get();

        return response()->json($workschedules->load(['org']));
    }

    public function show(Request $request)
    {
        $this->authorize('workschedule_read');

        $workschedule = WorkSchedule::find($request->workschedule);

        return response()->json($workschedule->load(['org','company']));
    }

    public function store(WorkScheduleRequest $request)
    {
        $this->authorize('workschedule_create');

        $org = session('selected_org_id');

        $workschedule             = new WorkSchedule();
        $workschedule->org_id     = $org;
        $workschedule->company_id = $request->company_id;
        $workschedule->name       = $request->name;
        $workschedule->created_by = auth()->id();
        $workschedule->save();

        $userId = auth()->id();

        info("User id=$userId stored new workschedule id=$workschedule->id to organization id=$org");

        return response()->json(true);
    }

    public function update(WorkScheduleRequest $request)
    {
        $this->authorize('workschedule_update');

        $workschedule       = WorkSchedule::find($request->workschedule);
        $workschedule->name = $request->name;
        $workschedule->update();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId update workschedule id=$workschedule->id for organization id=$org");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('workschedule_destroy');

        $userId       = auth()->id();
        $org          = session('selected_org_id');
        $workschedule = WorkSchedule::find($request->workschedule);

        info("User id=$userId trying to destroy workschedule id=$workschedule->id for organization id=$org");

        $workschedule->delete();

        return response()->json(true);
    }
}
