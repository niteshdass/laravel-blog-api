<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'content' => $faker->text(1000),
        'category_id' => $faker->numberBetween(1, 10),
    ];
});
