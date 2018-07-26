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

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cat_id' => $faker->numberBetween($min = 1, $max = 6),
        'image_url' => $faker->imageUrl($width = 350, $height = 300),
        'description' => $faker->text,
        'price_rub' =>$faker->numberBetween($min = 300, $max = 3000),
        'quantity' => $faker->numberBetween($min = 1, $max = 10),
        'created_at' =>$faker->dateTime($min = '2018-07-01'),
        'updated_at' =>$faker->dateTime($min = '2018-07-01')
    ];
});
