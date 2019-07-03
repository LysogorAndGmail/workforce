<?php
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // JobTitleCategory routes
    Route::get('/job-title-categories', 'Admin\JobTitleCategoryController@index');
    Route::get('/job-title-category/{jobTC}/show', 'Admin\JobTitleCategoryController@show');
    Route::put('/job-title-category/{jobTC}/update', 'Admin\JobTitleCategoryController@update');
    Route::post('/job-title-category/store', 'Admin\JobTitleCategoryController@store');
    Route::delete('/job-title-category/{jobTC}/destroy', 'Admin\JobTitleCategoryController@destroy');

    // JobTitle routes
    Route::get('/job-titles', 'Admin\JobTitleController@index');
    Route::get('/job-title/{jobTitle}/show', 'Admin\JobTitleController@show');
    Route::put('/job-title/{jobTitle}/update', 'Admin\JobTitleController@update');
    Route::post('/job-title/store', 'Admin\JobTitleController@store');
    Route::delete('/job-title/{jobTitle}/destroy', 'Admin\JobTitleController@destroy');

    // Operations routes
    Route::get('/operations', 'Admin\OperationController@index');
    Route::get('/operation/{operation}/show', 'Admin\OperationController@show');
    Route::put('/operation/{operation}/update', 'Admin\OperationController@update');
    Route::post('/operation/store', 'Admin\OperationController@store');
    Route::delete('/operation/{operation}/destroy', 'Admin\OperationController@destroy');

    // SubOperations routes
    Route::get('/sub-operations', 'Admin\SubOperationController@index');
    Route::get('/sub-operation/{subOperation}/show', 'Admin\SubOperationController@show');
    Route::put('/sub-operation/{subOperation}/update', 'Admin\SubOperationController@update');
    Route::post('/sub-operation/store', 'Admin\SubOperationController@store');
    Route::delete('/sub-operation/{subOperation}/destroy', 'Admin\SubOperationController@destroy');

    // Countries routes
    Route::get('/countries', 'Admin\CountryController@index');
    Route::get('/country/{country}/show', 'Admin\CountryController@show');
    Route::put('/country/{country}/update', 'Admin\CountryController@update');
    Route::post('/country/store', 'Admin\CountryController@store');
    Route::delete('/country/{country}/destroy', 'Admin\CountryController@destroy');
});
