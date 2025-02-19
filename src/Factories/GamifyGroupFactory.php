<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Sajidbashir24h\Gamify\GamifyGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'type' => $faker->randomElement(['badge', 'point']),
    ];
});
