<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesActivityTypeRequest;
use App\SalesActivityType;
use App\Role;
use Illuminate\Http\Request;

class SalesActivityTypeController extends Controller
{
    public function index()
    {
        $this->authorize('sales_activity_type_read');

        $types = SalesActivityType::where('org_id', session('selected_org_id'))->get();
        foreach($types as $type){
            $type->roles_full = Role::whereIn('id', $type->roles)->get();
        }
        return response()->json($types);
    }

    public function store(SalesActivityTypeRequest $request)
    {
        $this->authorize('sales_activity_type_create');

        $type               = new SalesActivityType();
        $type->org_id       = session('selected_org_id');
        $type->name         = $request->name;
        $type->roles        = $request->roles;
        $type->show_address = ($request->show_address) ? 1 : 0;
        $type->save();

        $userId = auth()->id();
        info("User id=$userId stored new sales activity type id=$type->id to organization id=$type->org_id");

        return response()->json(true);
    }

    public function show(SalesActivityType $type)
    {
        $this->authorize('sales_activity_type_read');

        return response()->json($type);
    }

    public function update(SalesActivityType $type, SalesActivityTypeRequest $request)
    {
        $this->authorize('sales_activity_type_update');

        $type->name         = $request->name;
        $type->roles        = $request->roles;
        $type->show_address = ($request->show_address) ? 1 : 0;
        $type->update();

        $userId = auth()->id();
        info("User id=$userId updated sales activity type id=$type->id to organization id=$type->org_id");

        return response()->json(true);
    }

    public function destroy(SalesActivityType $type)
    {
        $this->authorize('sales_activity_type_destroy');

        $userId = auth()->id();
        info("User id=$userId deleted sales activity type id=$type->id to organization id=$type->org_id");

        $type->delete();

        return response()->json(true);
    }
}
