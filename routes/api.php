<?php

use Illuminate\Support\Facades\Route;

Route::get('test', 'ApiController@test');
Route::post('test', 'ApiController@test');

Route::middleware(['api.format'])->group(function () {
    //статус
    Route::any('status', 'ApiController@status');

    //сессии (открыть/закрыть/...)
    Route::post('session_open', 'SessionController@session_open');
    Route::post('session_close', 'SessionController@session_close');
    Route::post('session_info', 'SessionController@session_info');

    //обязательное использование сессий
    Route::middleware(['api.session'])->group(function () {
        //users
        Route::post('user_add', 'UserController@user_add');
        Route::post('user_get', 'UserController@user_get');
        Route::post('user_set', 'UserController@user_set');
        Route::post('user_exist', 'UserController@user_exist');
        Route::post('user_list', 'UserController@user_list');
        Route::post('user_add', 'UserController@user_add');
        Route::post('user_delete', 'UserController@user_delete');
        //groups
        Route::post('group_add', 'GroupController@group_add');
        Route::post('group_get', 'GroupController@group_get');
        Route::post('group_set', 'GroupController@group_set');
        Route::post('group_exist', 'GroupController@group_exist');
        Route::post('group_list', 'GroupController@group_list');
        Route::post('group_add', 'GroupController@group_add');
        Route::post('group_delete', 'GroupController@group_delete');
        //app
        Route::post('app_add', 'WebAppController@app_add');
        Route::post('app_get', 'WebAppController@app_get');
        Route::post('app_set', 'WebAppController@app_set');
        Route::post('app_exist', 'WebAppController@app_exist');
        Route::post('app_list', 'WebAppController@app_list');
        Route::post('app_add', 'WebAppController@app_add');
        Route::post('app_delete', 'WebAppController@app_delete');
        //rubric
        Route::post('rubric_add', 'RubricController@rubric_add');
        Route::post('rubric_get', 'RubricController@rubric_get');
        Route::post('rubric_set', 'RubricController@rubric_set');
        Route::post('rubric_exist', 'RubricController@rubric_exist');
        Route::post('rubric_list', 'RubricController@rubric_list');
        Route::post('rubric_add', 'RubricController@rubric_add');
        Route::post('rubric_delete', 'RubricController@rubric_delete');
        Route::post('rubric_user', 'RubricController@rubric_user');
        //subscribe
        Route::post('subscribe_get', 'SubscribeController@subscribe_get');
        Route::post('subscribe_set', 'SubscribeController@subscribe_set');
        Route::post('subscribe_add', 'SubscribeController@subscribe_add');
        Route::post('subscribe_delete', 'SubscribeController@subscribe_delete');
        Route::post('subscribe_list', 'SubscribeController@subscribe_list');
        Route::post('subscribe_user_rubrics', 'SubscribeController@subscribe_user_rubrics');
        Route::post('subscribe_user_clear', 'SubscribeController@subscribe_user_clear');
        Route::post('subscribe_rubric_users', 'SubscribeController@subscribe_rubric_users');
    });

    //прочие методы
    Route::any('', 'ApiController@index');
    Route::any('{page}', 'ApiController@undef')->where('page', '.*');
});



