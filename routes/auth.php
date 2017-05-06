<?php

//Able routes for all system users

// Users

Route::get('user/edit', [
    'uses' => 'Auth\UserController@edit',
    'as' => 'user.edit',
])->middleware('auth');

Route::post('user/edit', [
    'uses' => 'Auth\UserController@update',
])->middleware('auth');

// Clients

Route::get('clients', [
    'uses' => 'ClientController@index',
    'as' => 'client.index',
]);

Route::get('client/{client}', [
    'uses' => 'ClientController@show',
    'as' => 'client.show'
]);

//Vehicles

Route::get('vehicle/{vehicle}', [
    'uses' => 'VehicleController@show',
    'as' => 'vehicle.show'
]);

Route::get('vehicles', [
    'uses' => 'VehicleController@index',
    'as' => 'vehicle.index'
]);