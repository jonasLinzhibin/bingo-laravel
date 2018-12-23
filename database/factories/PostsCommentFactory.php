<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\Post\PostsComments::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'post_id' => function () {
            return factory(App\Models\Admin\Post\Posts::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
