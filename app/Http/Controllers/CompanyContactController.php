<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\CompanyContact;

class CompanyContactController extends Controller
{
    public function companyContacts(Request $request)
    {
        $this->authorize('company_contact_read');

        $contacts = CompanyContact::where('company_id', $request->company)->where('branch_id', null)->get();

        return response()->json($contacts);
    }

    public function branchContacts(Request $request)
    {
        $this->authorize('company_contact_read');

        $contacts = CompanyContact::where('company_id', $request->company)->where('branch_id', $request->branch)->get();

        return response()->json($contacts);
    }

    public function show(Request $request)
    {
        $this->authorize('company_contact_read');

        $contact = CompanyContact::find($request->contact);

        return response()->json($contact->load('companyBranch'));
    }

    public function store(CompanyContactRequest $request)
    {
        $this->authorize('company_contact_create');

        $contact             = new CompanyContact();
        $contact->company_id = $request->company_id;
        $contact->fname      = $request->fname;
        $contact->lname      = $request->lname;
        if ($request->branch) {
            $contact->branch_id = $request->branch;
        }
        $contact->phone      = $request->phone;
        $contact->email      = $request->email;
        $contact->job_title  = $request->job_title;
        $contact->created_by = auth()->id();
        $contact->save();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId stored new company contact id=$contact->id to company id=$contact->company_id for organization_id=$org");

        return response()->json(true);
    }

    public function update(CompanyContactRequest $request)
    {
        $this->authorize('company_contact_update');

        $contact            = CompanyContact::find($request->contact);
        $contact->fname     = $request->fname;
        $contact->lname     = $request->lname;
        $contact->phone     = $request->phone;
        $contact->email     = $request->email;
        $contact->job_title = $request->job_title;
        $contact->update();

        $userId = auth()->id();
        $org    = session('selected_org_id');

        info("User id=$userId update company contact id=$contact->id for company id=$contact->company_id for organization_id=$org");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('company_contact_destroy');

        $userId  = auth()->id();
        $org     = session('selected_org_id');
        $contact = CompanyContact::find($request->contact);

        info("User id=$userId trying to destroy compnay contact id=$contact->id for company id=$contact->company_id for organization_id=$org");

        $contact->delete();

        return response()->json(true);
    }
}
