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

$factory->define(Cawoch\Client::class, function (Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'snd_last_name' => $faker->lastName,
        'id_card' => $faker->randomNumber(8).$faker->randomLetter,
        'address' => $faker->address,
        'postal_code' => $faker->postcode,
        'email' => $faker->unique()->email,
        'car_plate' => $faker->regexify('[0-9]{4}[A-Z]{3}'),
        'note' => $faker->paragraphs(3, true),
    ];
});

$factory->define(Cawoch\Vehicle::class, function (Faker\Generator $faker) {

    return [
        'client_id' => function () {
            return factory(Cawoch\Client::class)->create()->id;
        },
        'trademark' => $faker->randomElement(['Renault', 'Citroen', 'Mercedes', 'BMW', 'Porsche', 'Ford']),
        'model' => $faker->word,
        'plate' => $faker->regexify('[0-9]{4}[A-Z]{3}'),
        'serial' => $faker->uuid,
        'power' => $faker->numberBetween(60, 300),
        'displacement' => $faker->numberBetween(400, 3000),
        'cams' => $faker->numberBetween(10, 30),
        'color' => $faker->colorName,
        'doors' => $faker->numberBetween(2, 8),
        'kilometers' => $faker->numberBetween(0, 500000),
    ];
});

$factory->define(Cawoch\Phone::class, function (Faker\Generator $faker) {

    return [
        'client_id' => function () {
            return factory(Cawoch\Client::class)->create()->id;
        },
        'number' => $faker->phoneNumber,
    ];
});
