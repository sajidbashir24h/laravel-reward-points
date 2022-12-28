<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Sajidbashir24h\Gamify\Badge::class, function (Faker $faker) {
    return [
        'name'        => $faker->text(50),
        'description' => $faker->text,
    ];
});
