<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'url' => 'https://www.youtube.com/watch?v=ibgkLzQVgjo',
        'name' => $this->faker->text(rand(50, 150)),
    ];
});
