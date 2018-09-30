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

$factory->define(App\Campaign::class, function (Faker $faker) {
    return [
        'name' => $faker->name.'Campaign',
        'description' => 'Nasty description for a campaign.',
        'image' => 'https://via.placeholder.com/381x315',
        'color_scheme' => 'success',
        'type' => 'executive',
        'opened_until' => now()->addDays(1),
        'is_visible' => true,
    ];
});
