<?php

namespace App\Http\Controllers;

use App\Country;
use App\JobTitle;
use App\Operation;
use App\SubOperation;
use Illuminate\Http\Request;

class ClassifierController extends Controller
{
    public function operations()
    {
        $operations = Operation::all();

        return response()->json($operations->load('subOperations'));
    }

    public function countries()
    {
        $countries = Country::all();

        return response()->json($countries);
    }

    public function jobTitles()
    {
        $jobTitles = JobTitle::all();

        return response()->json($jobTitles);
    }
}
