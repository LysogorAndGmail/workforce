<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocRequest;
use Illuminate\Support\Facades\Storage;
use App\Doc;

class DocController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('doc_read');

        $docs = Doc::where('folder_id', $request->folder)->get();

        return response()->json($docs->load('folder'));
    }

    public function company(Request $request)
    {
        $this->authorize('doc_read');

        $docs = Doc::where('company_id', $request->company)->get();

        return response()->json($docs->load('folder'));
    }

    public function download(Request $request)
    {
        $this->authorize('doc_read');

        $doc = Doc::find($request->doc);
        if ( ! $doc->folder_id) {
            $file_full_path = 'docs/' . $doc->company_id . '/0';
        } else {
            $file_full_path = 'docs/' . $doc->company_id . '/' . $doc->folder_id;
        }
        $file_name = $doc->filename;

        $path = storage_path('app/' . $file_full_path . '/' . $file_name);

        return response()->download($path);

    }

    public function upload(Request $request)
    {
        $this->authorize('doc_read');

        return response()->json(true);

    }


    public function show(Request $request)
    {
        $this->authorize('doc_read');

        $doc = Doc::find($request->doc);
        if ( ! $doc->folder_id) {
            $file_full_path = 'docs/' . $doc->company_id . '/0';
        } else {
            $file_full_path = 'docs/' . $doc->company_id . '/' . $doc->folder_id;
        }
        $file_name = $doc->filename;
        $file_path = storage_path() . '/app/' . $file_full_path . '/' . $file_name;

        $doc->path = $file_path;

        return response()->json($doc->load(['folder', 'createdUser', 'company']));
    }

    public function store(DocRequest $request)
    {
        $this->authorize('doc_create');

        $orgId  = session('selected_org_id');
        $userId = auth()->id();

        $files = $request->file('files');

        for ($i = 0; $i < $request->count_files; $i++) {

            $file = $files[$i];

            $extension = $file->getClientOriginalExtension();
            $filename  = uniqid() . '.' . $extension;

            $mime = $file->getClientMimeType();

            $size = $file->getClientSize();

            $folder = 0;

            if ( ! empty($request->folder_id)) {
                $folder = $request->folder_id;
            }

            Storage::disk('local')->putFileAs('/docs/' . $request->company_id . '/' . $folder . '/', $file, $filename);

            $doc             = new Doc();
            $doc->company_id = $request->company_id;
            if ( ! empty($request->folder_id)) {
                $doc->folder_id = $folder;
            }
            $doc->name       = $file->getClientOriginalName();
            $doc->filename   = $filename;
            $doc->dbname     = $filename;
            $doc->ext        = $extension;
            $doc->mime       = $mime;
            $doc->size       = $size;
            $doc->created_by = $userId;

            $doc->save();

        }

        info("User id=$userId stored new doc id=$doc->id for org id=$orgId");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('doc_destroy');

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        $doc = Doc::find($request->doc);

        $folder = 0;

        if ( ! empty($doc->folder_id)) {
            $folder = $doc->folder_id;
        }

        Storage::delete("docs/$doc->company_id/$folder/$doc->filename");

        $doc->delete();

        info("User id=$userId deleted doc id=$doc->id for org id=$orgId");

        return response()->json(true);
    }
}
