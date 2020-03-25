<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Developer::class, function (Faker $faker) {
    return [
        'first_name' => $faker->text(20),
        'last_name' => $faker->text(20),
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->text(10),
        'position' => $faker->text(10),
        'role' => $faker->text(20),
    ];
});
