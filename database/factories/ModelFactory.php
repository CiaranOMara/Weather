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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Humidity::class, function (Faker\Generator $faker) {

    static $startDate = '-1 day';

    return [
        'value' => $faker->randomFloat(2,18,25), //TODO: set to realistic relative humidity value.
        'created_at' => $faker->dateTimeBetween($startDate)
    ];
});

$factory->state(App\Humidity::class, 'low', function (Faker\Generator $faker) {
    return [
        'value' => $faker->randomFloat(2,10,18), //TODO: set to realistic relative humidity value.
    ];
});

$factory->state(App\Humidity::class, 'high', function (Faker\Generator $faker) {
    return [
        'value' => $faker->randomFloat(2,25,30), //TODO: set to realistic relative humidity value.
    ];
});

$factory->define(App\Temperature::class, function (Faker\Generator $faker) {

    static $startDate = '-1 day';

    return [
        'value' => $faker->randomFloat(2,18,25),
        'created_at' => $faker->dateTimeBetween($startDate)
    ];
});

$factory->state(App\Temperature::class, 'low', function (Faker\Generator $faker) {
    return [
        'value' => $faker->randomFloat(2,10,18),
    ];
});

$factory->state(App\Temperature::class, 'high', function (Faker\Generator $faker) {
    return [
        'value' => $faker->randomFloat(2,25,30),
    ];
});


$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(2, true),
        'slug' => $faker->slug(2),
        'description' => '',
    ];
});
$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(2, true),
        'slug' => $faker->slug(2),
        'description' => '',
        'model' => $faker->words(1, true),
    ];
});