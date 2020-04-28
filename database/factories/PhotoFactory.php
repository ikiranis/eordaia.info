<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Photo;
use Faker\Generator as Faker;

$factory->define(Photo::class, function (Faker $faker) {
    return [
        'url' => 'https://picsum.photos/500',
        'description' => $faker->sentence(15)
    ];
});
