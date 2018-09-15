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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'profile_name' => 'profile-name-'.mt_rand(1000, 9999),
        'phone' => mt_rand(1000000000, 9999999999),
        'city' => 'BUCUREȘTI',
        'region' => 'Sector 5',
        'institution' => 'Colegiul '.str_random(10),
        'starting_year' => now()->subYears(4)->format('Y'),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
