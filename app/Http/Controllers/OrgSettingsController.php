<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrgSettingsRequest;
use App\OrgSettings;
use function auth;
use function info;
use function response;
use function session;

class OrgSettingsController extends Controller
{
    public function show(OrgSettings $settings)
    {
        $this->authorize('org_settings_read');
        
        return response()->json($settings);
    }
    
    public function update(OrgSettings $orgSettings, OrgSettingsRequest $request)
    {
        $this->authorize('org_settings_update');
        
        $orgSettings->status_length_days = $request->status_length_days;
        $orgSettings->update();
        
        $orgId = session('selected_org_id');
        $userId = auth()->id();
        
        info("User id=$userId updated org settings id=$orgSettings->id for org id=$orgId");
        
        return response()->json(true);
    }
}
