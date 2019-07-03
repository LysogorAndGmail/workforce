<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequest;
use Illuminate\Http\Request;
use App\Operation;
use App\SubOperation;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::all();

        return response()->json($operations);
    }

    public function show(Request $request, Operation $operation)
    {
        $operation = Operation::find($request->operation);

        return response()->json($operation);
    }

    public function getAllSubOperations(Request $request)
    {
        $operationIds = explode(',', $request->operations);

        $subOperations = SubOperation::whereIn('operation_id', $operationIds)->get();

        return response()->json($subOperations);
    }

    public function store(OperationRequest $request)
    {
        $operation       = new Operation();
        $operation->name = $request->name;
        $operation->save();

        return response()->json(true);
    }

    public function update(OperationRequest $request, Operation $operation)
    {
        $operation->name = $request->name;
        $operation->update();

        return response()->json(true);
    }

    public function destroy(Operation $operation)
    {
        if ($operation->subOperations->count() > 0) {
            return response()->json(['message' => 'Cannot delete, has Sub Operation'], 422);
        }
        $operation->delete();

        return response()->json(true);
    }
}
