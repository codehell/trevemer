<?php

// Clients

Route::get('client/create', [
    'uses' => 'ClientController@create',
    'as' => 'client.create',
]);

Route::post('client/create', [
    'uses' => 'ClientController@store',
]);

Route::get('client/{client}/edit', [
    'uses' => 'ClientController@edit',
    'as' => 'client.edit',
]);

Route::post('client/{client}/edit', [
    'uses' => 'ClientController@update',
]);


// Orders

Route::get('order/{client}/create', [
    'uses' => 'OrderController@create',
    'as' => 'order.create',
]);