<?php

use Carbon\Carbon;
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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => mt_rand(1000000000, 9999999999),
        'city' => 'București',
        'region' => 'Sector 5',
        'institution' => 'Colegiul '.str_random(10),
        'starting_year' => now()->subYears(4)->format('Y'),
        'graduation_year' => now()->format('Y'),
        'is_admin' => false,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\User::class, 'admin', function (Faker $faker) {
    return [
        'is_admin' => true,
    ];
});
