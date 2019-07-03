<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocFolderRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\DocFolder;
use App\Doc;

class DocFolderController extends Controller
{
    private $parentIds = array();

    private $childrenIds = array();

    public function index(Request $request)
    {
        $this->authorize('doc_folder_read');

        $folders = DocFolder::where('company_id', $request->company)->get();

        return response()->json($folders->load('company'));
    }

    public function show(Request $request)
    {
        $this->authorize('doc_folder_read');

        $docFolder = DocFolder::find($request->docfolder);

        $docFolders = DocFolder::where('parent_id', $request->docfolder)->get();

        $docs = Doc::where('folder_id', $request->docfolder)->get();

        return response()->json([
            'docfolder' => $docFolder->load(['company', 'createdUser', 'docs']),
            'folders'   => $docFolders->load(['company', 'createdUser', 'docs']),
            'docs'      => $docs->load(['company'])
        ]);
    }

    public function breadcrumb(Request $request)
    {
        $this->authorize('doc_folder_read');

        $this->checkParentFolder($request->docfolder);

        array_shift($this->parentIds);

        $Ids = array_reverse($this->parentIds);

        return response()->json($Ids);
    }

    public function store(DocFolderRequest $request)
    {
        $this->authorize('doc_folder_create');

        $orgId  = session('selected_org_id');
        $userId = auth()->id();

        $docFolder             = new DocFolder();
        $docFolder->company_id = $request->company_id;
        $docFolder->name       = $request->name;
        $docFolder->parent_id  = $request->parent_id;
        $docFolder->created_by = $userId;

        $docFolder->save();

        info("User id=$userId stored new docFolder id=$docFolder->id for org id=$orgId");

        return response()->json(true);
    }

    public function update(DocFolderRequest $request)
    {
        $this->authorize('doc_folder_update');

        $docFolder = DocFolder::find($request->docfolder);

        $docFolder->name = $request->name;

        $docFolder->update();

        $userId = auth()->id();
        $orgId  = session('selected_org_id');

        info("User id=$userId updated docFolder id=$docFolder->id for org id=$orgId");

        return response()->json(true);
    }

    public function destroy(Request $request)
    {
        $this->authorize('doc_folder_destroy');

        $userId    = auth()->id();
        $orgId     = session('selected_org_id');

        $this->childrenIds[] = (int) $request->docfolder;

        $this->checkChildrenFolder($request->docfolder);

        foreach ($this->childrenIds as $folder){
            $docFolder = DocFolder::find($folder);
            $folderDocs = Doc::where('folder_id', $folder)->get();
            foreach ($folderDocs as $folderdoc){
                Storage::delete("docs/$docFolder->company_id/$folder/$folderdoc->filename");
            }
            DB::table('docs')->where('folder_id', '=', $folder)->delete();
            $docFolder->delete();
        }

        info("User id=$userId deleted docFolder id=$docFolder->id for org id=$orgId");

        return response()->json(true);
    }

    private function checkParentFolder($folder_id){
        $docFolder = DocFolder::find($folder_id);
        if(!empty($docFolder)){
            $this->parentIds[] = array((int) $folder_id,$docFolder->name);
            $this->checkParentFolder($docFolder->parent_id);
        }
    }

    private function checkChildrenFolder($folder_id){
            $docFolders = DocFolder::where('parent_id', $folder_id)->get();
            if(!empty($docFolders)){
                foreach ($docFolders as $folder){
                    $this->childrenIds[] = (int) $folder->id;
                    $this->checkChildrenFolder($folder->id);
                }

            }
        }

}
