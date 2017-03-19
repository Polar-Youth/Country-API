<?php

/**
 * --------------------------------------------------------------------------
 * Model Factories
 *--------------------------------------------------------------------------
 *
 * Here you may define all of your model factories. Model factories give
 * you a convenient way to create models for testing and seeding your
 * database. Just tell the factory how a default model should look.
 *
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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [

    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Categories::class, function (Faker\Generator $faker) {
    return ['name' => $faker->word];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Continents::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->country,
        'name' => $faker->countryCode,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Division::class, function (Faker\Generator $faker) {
    return [
        'ISO_3166_2' => $faker->countryISOAlpha3,
        'name'       => $faker->city,
    ];
});
