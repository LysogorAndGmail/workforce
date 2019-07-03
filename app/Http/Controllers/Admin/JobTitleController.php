<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobTitleRequest;
use Illuminate\Http\Request;
use App\JobTitle;

class JobTitleController extends Controller
{
    public function index()
    {
        $jobTitles = JobTitle::all();

        return response()->json($jobTitles->load('category'));
    }

    public function show(JobTitle $jobTitle)
    {
        return response()->json($jobTitle->load('category'));
    }

    public function store(JobTitleRequest $request)
    {
        $jobTitle              = new JobTitle();
        $jobTitle->name        = $request->name;
        $jobTitle->category_id = $request->category_id;
        $jobTitle->save();

        return response()->json(true);
    }

    public function update(JobTitleRequest $request, JobTitle $jobTitle)
    {
        $jobTitle->name        = $request->name;
        $jobTitle->category_id = $request->category_id;
        $jobTitle->update();

        return response()->json(true);
    }

    public function destroy(JobTitle $jobTitle)
    {
        $jobTitle->delete();

        return response()->json(true);
    }
}
