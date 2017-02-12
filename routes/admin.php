<?php


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