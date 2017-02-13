<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Cawoch\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'role' => 'user',
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Cawoch\Client::class, function (\Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'snd_last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'address' => $faker->address,
        'email' => $faker->unique()->email,
        'note' => $faker->paragraphs(3, true),
    ];
});
