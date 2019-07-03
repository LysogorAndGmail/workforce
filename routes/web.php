<?php
Route::get('/', 'PublicPageController@index');
Route::get('/login-register', 'PublicPageController@loginRegister');
Route::get('/lang/{lang}', 'LanguageController@changeLang');
Route::get('/session-lang', 'LanguageController@sessionLang');

Route::get('/api/token/validate', 'ValidateTokenController@validateToken');
Route::post('/api/user/create', 'ValidateTokenController@createUser');

Auth::routes();

//Route::group(['middleware' => ['auth']], function () {

    Route::get('/auth', 'HomeController@index');

    // Company Status routes
    Route::get('/company-statuses', 'CompanyStatusController@index');
    Route::get('/company-status/{status}/show', 'CompanyStatusController@show');
    Route::put('/company-status/{status}/update', 'CompanyStatusController@update');
    Route::post('/company-status/store', 'CompanyStatusController@store');
    Route::delete('/company-status/{status}/destroy', 'CompanyStatusController@destroy');

    // Countries routes
    Route::get('/countries', 'CountryController@index');
    Route::get('/country/{country}/show', 'CountryController@show');
    Route::put('/country/{country}/update', 'CountryController@update');
    Route::post('/country/store', 'CountryController@store');
    Route::delete('/country/{country}/destroy', 'CountryController@destroy');

    // Companies routes
    Route::get('/companies', 'CompanyController@index');
    Route::get('/company/{search}/search', 'CompanyController@search');
    Route::post('/company/store', 'CompanyController@store');
    Route::put('/company/{company}/update', 'CompanyController@update');
    Route::get('/company/{company}/show', 'CompanyController@show');
    Route::get('/company/{company}/logo/show', 'CompanyController@showLogo');
    Route::delete('/company/{company}/logo/destroy', 'CompanyController@destroyLogo');
    Route::delete('/company/{company}/destroy', 'CompanyController@destroy');

    // Classifiers
    Route::group(['prefix' => 'classifier'], function () {
        Route::get('/operations', 'ClassifierController@operations');
        Route::get('/countries', 'ClassifierController@countries');
        Route::get('/job-titles', 'ClassifierController@jobTitles');
    });

    // CompanyBranches routes
    Route::get('/company-branches/{company}', 'CompanyBranchController@companyBranches');
    Route::get('/company-branch/{branch}/show', 'CompanyBranchController@show');
    Route::put('/company-branch/{branch}/update', 'CompanyBranchController@update');
    Route::post('/company-branch/store', 'CompanyBranchController@store');
    Route::delete('/company-branch/{branch}/destroy', 'CompanyBranchController@destroy');

    // CompanyContacts routes
    Route::get('/company-contacts/{company}', 'CompanyContactController@companyContacts');
    Route::get('/company-contacts/{company}/branch/{branch}', 'CompanyContactController@branchContacts');
    Route::get('/company-contact/{contact}/show', 'CompanyContactController@show');
    Route::put('/company-contact/{contact}/update', 'CompanyContactController@update');
    Route::post('/company-contact/store', 'CompanyContactController@store');
    Route::delete('/company-contact/{contact}/destroy', 'CompanyContactController@destroy');

    // Workforce routes
    Route::get('/workforces', 'WorkforceController@index');
    Route::get('/workforces/only-workforce', 'WorkforceController@onlyWorkforce');
    Route::get('/workforce/schedule', 'WorkforceController@scheduleWorkforces');
    Route::get('/workforce/{workforce}/show', 'WorkforceController@show');
    Route::put('/workforce/{workforce}/update', 'WorkforceController@update');
    Route::post('/workforce/store', 'WorkforceController@store');
    Route::delete('/workforce/{workforce}/destroy', 'WorkforceController@destroy');

    // Profile routes
    Route::get('/auth-user', 'UserProfileController@user');
    Route::get('/user-permissions', 'UserProfileController@userPermissions');

    // User Org routes
    Route::get('/user-organizations', 'UserOrgController@userOrgs');
    Route::get('/change-org/{org}', 'UserOrgController@changeOrg');
    Route::get('/session-org', 'UserOrgController@sessionOrg');

    // User Role routes
    Route::get('/user-roles', 'UserRoleController@userRoles');
    Route::get('/change-role/{role}', 'UserRoleController@changeRole');
    Route::get('/session-role', 'UserRoleController@sessionRole');

    // Org routes
    Route::get('/organization-users', 'OrgController@orgUsers');

    // Role routes
    Route::get('/roles', 'RoleController@index');
    Route::get('/role/{role}/show', 'RoleController@show');
    Route::put('/role/{role}/update', 'RoleController@update');
    Route::post('/role/store', 'RoleController@store');
    Route::delete('/role/{role}/destroy', 'RoleController@destroy');
    Route::get('/role/{role}/permission/{permission}/toggle-permission', 'RoleController@togglePermission');

    // Permission routes
    Route::get('/permissions', 'PermissionController@index');

    // Workschedule routes
    Route::get('/workschedules', 'WorkScheduleController@index');
    Route::get('/workschedules/{company}/company', 'WorkScheduleController@companyWorkSchedules');
    Route::get('/workschedule/{workschedule}/show', 'WorkScheduleController@show');
    Route::put('/workschedule/{workschedule}/update', 'WorkScheduleController@update');
    Route::post('/workschedule/store', 'WorkScheduleController@store');
    Route::delete('/workschedule/{workschedule}/destroy', 'WorkScheduleController@destroy');

    // Workday routes
    Route::get('/workdays/{work_schedule}', 'WorkdayController@index');
    Route::get('/workday/{workday}/show', 'WorkdayController@show');
    Route::put('/workday/{workday}/update', 'WorkdayController@update');
    Route::post('/workday/store', 'WorkdayController@store');
    Route::delete('/workday/{workday}/destroy', 'WorkdayController@destroy');

    // User routes
    Route::get('/users', 'UserController@index');
    Route::get('/user/{user}/show', 'UserController@show');
    Route::put('/user/{user}/update', 'UserController@update');
    Route::post('/user/store', 'UserController@store');
    Route::delete('/user/{user}/destroy', 'UserController@destroy');

    //Login in Account

    Route::get('/login-to-account', 'ValidateTokenController@loginToAccount');

    // Schedule routes
    Route::get('/schedule/{schedule}/workforces', 'ScheduleController@workforces');
    Route::post('/schedule/add-workforce', 'ScheduleController@addWorkforce');
    Route::delete('/schedule/{schedule}/{workforce}/destroy-workforce', 'ScheduleController@destroyWorkforce');

    // DocFolders routes
    Route::get('/docfolders/{company}', 'DocFolderController@index');
    Route::get('/docfolder/{docfolder}/show', 'DocFolderController@show');
    Route::get('/docfolder/{docfolder}/breadcrumb', 'DocFolderController@breadcrumb');
    Route::put('/docfolder/{docfolder}/update', 'DocFolderController@update');
    Route::post('/docfolder/store', 'DocFolderController@store');
    Route::delete('/docfolder/{docfolder}/destroy', 'DocFolderController@destroy');

    // Docs routes
    Route::get('/docs/{folder}', 'DocController@index');
    Route::get('/doc/{doc}/download', 'DocController@download');
    Route::get('/docs/{company}/company', 'DocController@company');
    Route::get('/doc/{doc}/show', 'DocController@show');
    Route::post('/doc/store', 'DocController@store');
    Route::post('/doc/upload', 'DocController@upload');
    Route::delete('/doc/{doc}/destroy', 'DocController@destroy');
    
    //Sales Activity
    Route::get('/sales-activity/{company}/all', 'SalesActivityController@index');
    Route::get('/sales-activity/{activity}/show', 'SalesActivityController@show');
    Route::post('/sales-activity/{company}/store', 'SalesActivityController@store');
    Route::put('/sales-activity/{activity}/update', 'SalesActivityController@update');
    Route::delete('/sales-activity/{activity}/destroy', 'SalesActivityController@destroy');

    //Sales Activity Type
    Route::get('/sales-activity-types', 'SalesActivityTypeController@index');
    Route::get('/sales-activity-type/{type}/show', 'SalesActivityTypeController@show');
    Route::post('/sales-activity-type/store', 'SalesActivityTypeController@store');
    Route::put('/sales-activity-type/{type}/update', 'SalesActivityTypeController@update');
    Route::delete('/sales-activity-type/{type}/destroy', 'SalesActivityTypeController@destroy');

    //User Settings routes
    Route::get('/user/settings/{userSettings}/show', 'UserSettingsController@show');
    Route::put('/user/settings/{userSettings}/update', 'UserSettingsController@update');
    
    // Org Settings
    Route::get('/org/settings/{settings}/show', 'OrgSettingsController@show');
    Route::put('/org/settings/{settings}/update', 'OrgSettingsController@update');
//});
