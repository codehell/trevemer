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

});


// Orders

Route::get('order/{client}/create', [
    'uses' => 'OrderController@create',
    'as' => 'order.create',
]);
