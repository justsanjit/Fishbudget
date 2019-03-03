<?php

use Faker\Generator as Faker;

$factory->define(App\Import::class, function (Faker $faker) {
    return [
        'file' => $faker->md5($faker->word) . 'csv',
        'status' => $faker->randomElement(['submitted', 'mapped', 'completed', 'failed']),
        'user_id' => function () {
            return factory('App\User')->create()->id;
        }
    ];
});

$factory->state(App\Import::class, 'submitted', function () {
    return [
        'status' => 'submitted'
    ];
});

$factory->state(App\Import::class, 'mapped', function () {
    return [
        'status' => 'mapped'
    ];
});

$factory->state(App\Import::class, 'completed', function () {
    return [
        'status' => 'completed'
    ];
});
