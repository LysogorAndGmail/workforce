<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Company;
use App\Operation;
use App\SubOperation;

class CompanyController extends Controller
{
    public function index()
    {
        $this->authorize('company_read');

        $sessionOrgId = session('selected_org_id');
        $companies    = Company::where('org_id', $sessionOrgId)->get();

        return response()->json($companies->load('status'));
    }

    public function show(Request $request)
    {
        $this->authorize('company_read');

        $company = Company::find($request->company);

        return response()->json($company->load(['organization', 'country', 'status', 'createdUser', 'branches']));
    }

    public function search(Request $request)
    {
        $this->authorize('company_read');

        $sessionOrgId = session('selected_org_id');
        $companies    = '';
        if ( ! empty($request->search)) {
            $companies = Company::where('org_id', $sessionOrgId)
                                ->where('name', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('reg', 'LIKE', '%' . $request->search . '%')->get();
        }

        return response()->json($companies->load('status'));
    }

    public function showLogo(Request $request)
    {
        $this->authorize('company_read');

        $company = Company::find($request->company);
        $logo    = false;

        if ($company->logo) {
            $logo = Storage::get("company/$company->id/logo/$company->logo");
            if ($logo) {
                $logo = base64_encode($logo);
            }
        }

        return response()->json($logo);
    }

    public function store(CompanyRequest $request)
    {
        $this->authorize('company_create');

        $orgId    = session('selected_org_id');
        $filename = null;
        $newfile  = null;
        $userId   = auth()->id();

        if ($request->logo) {
            $filename = md5(time()) . ".jpg";
            $newfile  = Image::make($request->logo)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75)->orientate();
        }

        $company                 = new Company();
        $company->org_id         = $orgId;
        $company->country_id     = $request->country_id;
        $company->status_id      = $request->status_id;
        $company->name           = $request->name;
        $company->reg            = $request->reg;
        $company->vat            = $request->vat;
        $company->legal_address  = $request->legal_address;
        $company->address        = $request->address;
        $company->operations     = $request->operations;
        $company->sub_operations = $request->sub_operations;
        $company->website        = $request->website;
        $company->phone          = $request->phone;
        $company->email          = $request->email;
        $company->bank_acc       = $request->bank_acc;
        $company->credit_score   = $request->credit_score ?? null;
        $company->source         = $request->source;
        $company->created_by     = $userId;

        if ($request->logo) {
            $company->logo = $filename;
        }

        $company->save();

        if ($request->logo) {
            Storage::put("company/$company->id/logo/$filename", $newfile->stream());
        }

        info("User id=$userId stored new company id=$company->id for org id=$orgId");

        return response()->json(true);
    }

    public function update(CompanyRequest $request)
    {
        $this->authorize('company_update');

        $company  = Company::find($request->company);
        $filename = null;

        if ($company->logo == null && $request->logo) {
            $filename = md5(time()) . ".jpg";
            $newfile  = Image::make($request->logo)->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode('jpg', 75)->orientate();
            Storage::put("company/$company->id/logo/$filename", $newfile->stream());
        }

        $company->country_id     = $request->country_id;
        $company->status_id      = $request->status_id;
        $company->name           = $request->name;
        $company->reg            = $request->reg;
        $company->vat            = $request->vat;
        $company->legal_address  = $request->legal_address;
        $company->address        = $request->address;
        $company->operations     = $request->operations;
        $company->sub_operations = $request->sub_operations;
        $company->website        = $request->website;
        $company->phone          = $request->phone;
        $company->email          = $request->email;
        $company->bank_acc       = $request->bank_acc;
        $company->credit_score   = $request->credit_score ?? null;
        $company->source         = $request->source;

        if ($filename) {
            $company->logo = $filename;
        }

        $company->update();

        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        info("User id=$userId updated company id=$company->id for org id=$orgId");

        return response()->json(true);
    }

    public function destroy(Company $company)
    {
        $this->authorize('company_destroy');

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        if ($company->logo) {
            Storage::delete("company/$company->id/logo/$company->logo");
        }

        $company->delete();

        info("User id=$userId deleted company id=$company->id for org id=$orgId");

        return response()->json(true);
    }

    public function destroyLogo(Request $request)
    {
        $this->authorize('company_destroy');

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        $company = Company::find($request->company);

        if ($company->logo) {

            info("User id=$userId deleted company logo id=$company->id for org id=$orgId");

            Storage::delete("company/$company->id/logo/$company->logo");
            $company->logo = null;
            $company->update();
        }

        return response()->json(true);
    }
}
