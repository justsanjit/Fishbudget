<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'type' => $this->faker->randomElement(['income', 'expense']),
        'amount' => $this->faker->randomNumber(),
        'description' => $this->faker->sentence,
        'date' => $this->faker->date,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
