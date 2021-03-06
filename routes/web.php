<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Route::get('/', ['as'=>'home','uses'=>'ReportController@index'])->middleware('auth');
Auth::routes();

/**
 * Report routes and actions which restricted to users
 */
Route::group(['prefix'=>'report', 'middleware' => 'auth'], function () {
    Route::get('/', ['as'=>'report.index', 'uses'=>'ReportController@index']);
    Route::get('/user/{userId}', ['as'=>'report.user.index', 'uses'=>'ReportController@index']);
    Route::get('/data/{userId?}', ['as'=>'report.list', 'uses'=>'ReportController@listData']);
    Route::get('create/', ['as'=>'report.create.step1', 'uses'=>'ReportController@create'])->middleware('role:admin');
    Route::get('create/{id}', ['as'=>'report.create.step2', 'uses'=>'ReportController@createStepTwo'])
        ->middleware('role:admin');
    Route::post('create', ['as'=>'report.store', 'uses'=>'ReportController@store'])->middleware('role:admin');
    Route::get('{id}', ['as'=>'report.show', 'uses'=>'ReportController@show']);
    Route::get('participate/{id}', ['as'=>'report.getParticipate', 'uses'=>'ReportController@getParticipate']);
    Route::put('participate/{id}', ['as'=>'report.putParticipate', 'uses'=>'ReportController@putParticipate']);
    Route::get('{id}/edit', ['as'=>'report.edit', 'uses'=>'ReportController@edit'])->middleware('role:admin');
    Route::put('{id}', ['as'=>'report.update', 'uses'=>'ReportController@update'])->middleware('role:admin');
    Route::delete('{id}', ['as'=>'report.destroy', 'uses'=>'ReportController@destroy'])->middleware('role:admin');
});

/**
 * Defect routes
 */
Route::group(['prefix' => 'defect','middleware'=>'auth'], function () {
    Route::get('{userId}/data', ['as' => 'defect.list', 'uses' => 'DefectController@listData'])
        ->middleware('role:admin|employee');
    Route::get('/{userId}', ['as' => 'defect.index', 'uses' => 'DefectController@index'])
        ->middleware('role:admin|employee');
    Route::get('{userId}/create', ['as' => 'defect.create', 'uses' => 'DefectController@create'])
        ->middleware('role:admin');
    Route::post('{userId}/create', ['as' => 'defect.store', 'uses' => 'DefectController@store'])
        ->middleware('role:admin');
    Route::get('{userId}/{id}/edit', ['as' => 'defect.edit', 'uses' => 'DefectController@edit'])
        ->middleware('role:admin');
    Route::put('{userId}/{id}', ['as' => 'defect.update', 'uses' => 'DefectController@update'])
        ->middleware('role:admin');
    Route::delete('{id}', ['as' => 'defect.destroy', 'uses' => 'DefectController@destroy'])
        ->middleware('role:admin');
});

/**
 * Bonus routes
 */
Route::group(['prefix' => 'bonus','middleware'=>'auth'], function () {
    Route::get('{userId}/data', ['as' => 'bonus.list', 'uses' => 'BonusController@listData'])
        ->middleware('role:admin|employee');
    Route::get('/{userId}', ['as' => 'bonus.index', 'uses' => 'BonusController@index'])
        ->middleware('role:admin|employee');
    Route::get('{userId}/create', ['as' => 'bonus.create', 'uses' => 'BonusController@create'])
        ->middleware('role:admin');
    Route::post('{userId}/create', ['as' => 'bonus.store', 'uses' => 'BonusController@store'])
        ->middleware('role:admin');
    Route::get('{userId}/{id}/edit', ['as' => 'bonus.edit', 'uses' => 'BonusController@edit'])
        ->middleware('role:admin');
    Route::put('{userId}/{id}', ['as' => 'bonus.update', 'uses' => 'BonusController@update'])
        ->middleware('role:admin');
    Route::delete('{id}', ['as' => 'bonus.destroy', 'uses' => 'BonusController@destroy'])
        ->middleware('role:admin');
});

/**
 *  Performance rule routes
 */
Route::group(['prefix'=>'rule', ['auth', 'role:admin']], function () {
    Route::get('/', ['as'=>'rule.index', 'uses'=>'PerformanceController@index']);
    Route::get('/create', ['as'=>'rule.create', 'uses'=>'PerformanceController@create']);
    Route::get('/data', ['as'=>'rule.list', 'uses'=>'PerformanceController@listData']);
    Route::post('/create', ['as'=>'rule.store', 'uses'=>'PerformanceController@store']);
    Route::get('{id}/edit', ['as'=>'rule.edit', 'uses'=>'PerformanceController@edit']);
    Route::put('{id}', ['as'=>'rule.update', 'uses'=>'PerformanceController@update']);
    Route::delete('{id}', ['as'=>'rule.destroy', 'uses'=>'PerformanceController@destroy']);
});


/**
 *  Project routes
 */
Route::group(['prefix'=>'project', ['auth', 'role:admin']], function () {
    Route::get('/', ['as'=>'project.index', 'uses'=>'ProjectController@index']);
    Route::get('/create', ['as'=>'project.create', 'uses'=>'ProjectController@create']);
    Route::get('/data', ['as'=>'project.list', 'uses'=>'ProjectController@listData']);
    Route::post('/create', ['as'=>'project.store', 'uses'=>'ProjectController@store']);
    Route::get('{id}/edit', ['as'=>'project.edit', 'uses'=>'ProjectController@edit']);
    Route::put('{id}', ['as'=>'project.update', 'uses'=>'ProjectController@update']);
    Route::delete('{id}', ['as'=>'project.destroy', 'uses'=>'ProjectController@destroy']);
});


/**
 *  sheets routes
 */
Route::group(['prefix'=>'sheet', 'middleware' => 'auth'], function () {
    Route::get('/', ['as'=>'sheet.index', 'uses'=>'SheetController@index']);
    Route::get('/create', ['as'=>'sheet.create', 'uses'=>'SheetController@create']);
    Route::get('/data', ['as'=>'sheet.list', 'uses'=>'SheetController@listData']);
    Route::post('/create', ['as'=>'sheet.store', 'uses'=>'SheetController@store']);
    Route::get('{id}/edit', ['as'=>'sheet.edit', 'uses'=>'SheetController@edit']);
    Route::put('{id}', ['as'=>'sheet.update', 'uses'=>'SheetController@update']);
    Route::delete('{id}', ['as'=>'sheet.destroy', 'uses'=>'SheetController@destroy']);
});

/**
 *  Time Sheets Report routes
 */
Route::group(['prefix'=>'timesheets/report', ['auth', 'role:admin']], function () {
    Route::get('/', ['as'=>'timesheets.index', 'uses'=>'SheetsReportController@index']);
//    Route::get('/create', ['as'=>'project.create', 'uses'=>'ProjectController@create']);
    Route::get('/data', ['as'=>'timesheets.list', 'uses'=>'SheetsReportController@listData']);
//    Route::post('/create', ['as'=>'project.store', 'uses'=>'ProjectController@store']);
//    Route::get('{id}/edit', ['as'=>'project.edit', 'uses'=>'ProjectController@edit']);
//    Route::put('{id}', ['as'=>'project.update', 'uses'=>'ProjectController@update']);
//    Route::delete('{id}', ['as'=>'project.destroy', 'uses'=>'ProjectController@destroy']);
});

/**
 * User routes
 */
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('user/data', ['as' => 'user.list', 'uses' => 'UserController@listData']);
    Route::resource('user', 'UserController');
});

/**
 * Monthly Statistics routes
 */
Route::group(['prefix' => 'statistics', 'middleware' => ['auth', 'role:employee']], function () {
    Route::get('/', ['as' => 'statistics.view', 'uses' => 'StatisticsController@index']);
    Route::post('/get', ['as' => 'statistics.get', 'uses' => 'StatisticsController@get']);
});
