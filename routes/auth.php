<?php

// Users

Route::get('user/edit', [
    'uses' => 'Auth\UserController@edit',
    'as' => 'user.edit',
])->middleware('auth');

Route::post('user/edit', [
    'uses' => 'Auth\UserController@update',
])->middleware('auth');

// Clients

Route::get('client/index', [
    'uses' => 'ClientController@index',
    'as' => 'client.index',
]);
