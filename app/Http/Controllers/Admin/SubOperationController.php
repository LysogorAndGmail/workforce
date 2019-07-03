<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubOperationRequest;
use Illuminate\Http\Request;
use App\SubOperation;

class SubOperationController extends Controller
{
    public function index()
    {
        $suboperations = SubOperation::all();

        return response()->json($suboperations->load('operation'));
    }

    public function show(SubOperation $subOperation)
    {
        return response()->json($subOperation->load('operation'));
    }

    public function store(SubOperationRequest $request)
    {
        $subOperation               = new SubOperation();
        $subOperation->name         = $request->name;
        $subOperation->operation_id = $request->operation_id;
        $subOperation->save();

        return response()->json(true);
    }

    public function update(SubOperationRequest $request, SubOperation $subOperation)
    {
        $subOperation->name         = $request->name;
        $subOperation->operation_id = $request->operation_id;
        $subOperation->update();

        return response()->json(true);
    }

    public function destroy(SubOperation $subOperation)
    {
        $subOperation->delete();

        return response()->json(true);
    }
}
