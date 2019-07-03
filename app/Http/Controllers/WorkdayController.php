<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkdayRequest;
use App\Workday;
use Carbon\Carbon;

class WorkdayController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('workday_read');

        $workdays = Workday::where('work_schedule_id', $request->work_schedule)->get();

        return response()->json($workdays);
    }

    public function show(Request $request)
    {
        $this->authorize('workday_read');

        $workday = Workday::find($request->workday);

        return response()->json($workday);
    }

    public function store(WorkdayRequest $request)
    {
        $this->authorize('workday_create');

        $org = session('selected_org_id');

        $workday                     = new Workday();
        $workday->work_schedule_id   = $request->work_schedule_id;
        $workday->workforce_id       = $request->workforce_id;
        $workday->start_date         = Carbon::parse($request->start_date);
        $workday->end_date           = Carbon::parse($request->end_date);
        $workday->created_by         = auth()->id();
        $workday->save();

        $userId = auth()->id();

        info("User id=$userId stored new workday id=$workday->id to organization id=$org");

        return response()->json(true);
    }

    public function update(WorkdayRequest $request)
    {
        $this->authorize('workday_update');

        $workday                     = Workday::find($request->workday);
        $workday->start_date         = Carbon::parse($request->start_date);
        $workday->end_date           = Carbon::parse($request->end_date);
        $workday->update();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId update workday id=$workday->id for organization id=$org");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('workday_destroy');

        $userId       = auth()->id();
        $org          = session('selected_org_id');
        $workday = Workday::find($request->workday);

        info("User id=$userId trying to destroy workday id=$workday->id for organization id=$org");

        $workday->delete();

        return response()->json(true);
    }
}
