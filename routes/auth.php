<?php

// Users

Route::get('user/{user}/edit', [
    'uses' => 'Auth\UserController@edit',
    'as' => 'user.edit',
]);

Route::post('user/{user}/edit', [
    'uses' => 'Auth\UserController@update',
]);

// Clients

Route::get('client/create', [
    'uses' => 'ClientController@create',
    'as' => 'client.create',
]);

Route::post('client/create', [
    'uses' => 'ClientController@store',
]);


// Orders

Route::get('order/{client}/create', [
    'uses' => 'OrderController@create',
    'as' => 'order.create',
]);