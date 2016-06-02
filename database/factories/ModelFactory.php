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

$factory->define(App\Customer::class, function (Faker\Generator $faker , $data) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'system_user' => 0,
        'password' =>  (isset($data['password'])) ? ($data['password']) : bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\User::class, function (Faker\Generator $faker , $data) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' =>  (isset($data['password'])) ? bcrypt($data['password']) : bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'price' => $faker->randomFloat(6, 0,1000),
    ];
});
