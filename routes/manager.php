<?php

// Clients

Route::group(['prefix' => 'client'], function () {

    Route::get('create', [
        'uses' => 'ClientController@create',
        'as' => 'client.create',
    ]);

    Route::post('create', [
        'uses' => 'ClientController@store',
    ]);

    Route::get('{client}/edit', [
        'uses' => 'ClientController@edit',
        'as' => 'client.edit',
    ]);

    Route::post('{client}/edit', [
        'uses' => 'ClientController@update',
    ]);

    Route::post('{client}/addphone', [
        'uses' => 'ClientController@addPhone',
        'as' => 'phone.create'
    ]);

});

// Vehicles

Route::group(['prefix' => 'vehicle'], function () {

    Route::get('create', [
        'uses' => 'VehicleController@create',
        'as' => 'vehicle.create'
    ]);

    Route::post('create', [
        'uses' => 'VehicleController@store'
    ]);

    Route::get('{vehicle}/edit', [
        'uses' => 'VehicleController@edit',
        'as' => 'vehicle.edit'
    ]);

    Route::put('{vehicle}/edit', [
        'uses' => 'VehicleController@update'
    ]);
});

// Orders

Route::get('order/{client}/create', [
    'uses' => 'OrderController@create',
    'as' => 'order.create',
]);
