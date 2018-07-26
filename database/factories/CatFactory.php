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

$factory->define(App\Cat::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'description' => $faker->text,
        'created_at' =>$faker->dateTime($min = '2018-07-01'),
        'updated_at' =>$faker->dateTime($min = '2018-07-01')
    ];
});
