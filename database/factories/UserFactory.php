<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\User::class, function (Faker $faker) {
	$faker->locale('en_PH'); 
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => '09' . $faker->randomNumber(9),
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Model\User::class, 'noDetail', function (Faker $faker) {
	$faker->locale('en_PH'); 
    return [
        'name' => '',
        'email' => '',
        'phone_number' => '',
        'password' => '',
        'remember_token' => str_random(10),
    ];
});
