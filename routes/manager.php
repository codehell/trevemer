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

//Phones

Route::delete('phone/{phone}', [
    'uses' => 'PhoneController@delete',
    'as' => 'phone.delete'
]);

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

Route::get('order/{vehicle}/create', [
    'uses' => 'OrderController@create',
    'as' => 'order.create',
]);
