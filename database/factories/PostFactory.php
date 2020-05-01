<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new FakerProvider($faker));

    return [
        'title' => $faker->sentence(15),
        'body' => $faker->markdown(),
        'approved' => true
    ];
});
