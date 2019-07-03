<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSettingsRequest;
use App\UserSettings;

class UserSettingsController extends Controller
{
    public function show(UserSettings $userSettings)
    {
        $this->authorize('user_settings_read');

        return response()->json($userSettings);
    }

    public function update(UserSettings $userSettings, UserSettingsRequest $request)
    {
        $this->authorize('user_settings_update');

        $userSettings->zero_sales_act_companies = $request->zero_sales_act_companies;
        $userSettings->update();

        $userId = auth()->id();
        $orgId  = session('selected_org_id');
        info("User id=$userId updated user settings for user id=$userSettings->user_id for org id=$orgId");

        return response()->json(true);
    }
}
