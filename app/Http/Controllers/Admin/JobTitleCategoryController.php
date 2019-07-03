<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobTitleCategoryRequest;
use Illuminate\Http\Request;
use App\JobTitleCategory;
use App\JobTitle;

class JobTitleCategoryController extends Controller
{
    public function index()
    {
        $AllJobTitleCategorys = JobTitleCategory::all();

        return response()->json($AllJobTitleCategorys);
    }

    public function show(Request $request, JobTitleCategory $jobTC)
    {
        $jobTC = JobTitleCategory::find($request->jobTC);

        return response()->json($jobTC);
    }

    public function store(JobTitleCategoryRequest $request)
    {
        $jobTC       = new JobTitleCategory();
        $jobTC->name = $request->name;
        $jobTC->save();

        return response()->json(true);
    }

    public function update(JobTitleCategoryRequest $request, JobTitleCategory $jobTC)
    {
        $jobTC->name = $request->name;
        $jobTC->update();

        return response()->json(true);
    }

    public function destroy(JobTitleCategory $jobTC)
    {
        if ($jobTC->jobTitles->count() > 0) {
            return response()->json(['message' => 'Cannot delete, has Job Titles'], 422);
        }
        $jobTC->delete();

        return response()->json(true);
    }
}
