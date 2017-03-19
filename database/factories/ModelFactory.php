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
$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'continent_id'  => function () { return factory(App\Continents::class)->create()->id; },
        'code'          => $faker->randomNumber(3),
        'name'          => $faker->country,
        'flag'          => $faker->imageUrl(),
        'fips_code'     => $faker->countryCode,
        'iso_code'      => $faker->iso8601,
        'north_num'     => $faker->latitude,
        'south_num'     => $faker->latitude,
        'east_num'      => $faker->latitude,
        'west_num'      => $faker->latitude,
        'capital'       => $faker->city,
        'iso_alpha_2'   => $faker->countryISOAlpha3,
        'iso_alpha_3'   => $faker->countryISOAlpha3,
        'geoname_id'    => $faker->numberBetween(0, 100)
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
