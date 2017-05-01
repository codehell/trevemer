<?php

Route::get('register', [
    'uses' => 'Auth\RegisterController@showRegistrationForm',
    'as' => 'register',
]);

Route::post('register', [
    'uses' => 'Auth\RegisterController@register'
]);

Route::get('user/{user}', [
    'uses' => 'Auth\UserController@show',
    'as' => 'user.show'
]);

Route::delete('user/{user}/delete', [
    'uses' => 'Auth\UserController@delete',
    'as' => 'user.delete'
]);