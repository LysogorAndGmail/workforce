<?php

namespace App\Http\Controllers;

use App\Workforce;
use App\WorkSchedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function workforces(Request $request)
    {
        $this->authorize('workschedule_workforces_read');

        $workforces = WorkSchedule::where('id', $request->schedule)->get();

        return response()->json($workforces->load(['workforces']));
    }

    public function addWorkforce(Request $request)
    {
        $this->authorize('workschedule_workforces_create');

        $workSchedule = WorkSchedule::find($request->work_schedule_id);

        foreach ($request->workforces as $workforce) {
            if(!$workSchedule->workforces->contains($workforce)){
                $workSchedule->workforces()->attach($workforce);
            }
        }

        $userId = auth()->id();
        $org = session('selected_org_id');

        info("User id=$userId stored new workforce id=$request->workforce_id  to workschedule id=$request->work_schedule_id from organization id=$org");

        return response()->json(true);
    }

    public function destroyWorkforce(Request $request)
    {
        $this->authorize('workschedule_workforces_destroy');

        $workSchedule = WorkSchedule::find($request->schedule);
        $workSchedule->workforces()->detach($request->workforce);

        $userId = auth()->id();
        $org = session('selected_org_id');

        info("User id=$userId destroy workforce id=$request->workforce  from workschedule id=$request->schedule and organization id=$org");

        return response()->json(true);
    }


}
