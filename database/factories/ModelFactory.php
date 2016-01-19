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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Host::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'website' => $faker->url,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'category_id' => factory(App\Category::class)->create()->id,
        'host_id' => factory(App\Host::class)->create()->id,
        'name' => $faker->name,
        'disk' => $faker->randomNumber(),
        'memory' => $faker->randomNumber(),
        'cpu' => $faker->randomNumber(),
        'bandwidth' => $faker->randomNumber(),
        'websites' => $faker->randomNumber(),
        'managed' => $faker->boolean(),
        'website' => $faker->url,
    ];
});

