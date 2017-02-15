<?php

Route::get('register', [
    'uses' => 'Auth\RegisterController@showRegistrationForm',
    'as' => 'register',
]);

Route::post('register', [
    'uses' => 'Auth\RegisterController@Register'
]);