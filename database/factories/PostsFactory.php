<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Post\Posts::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
    ];
});
