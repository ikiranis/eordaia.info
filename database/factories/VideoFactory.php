<?php

namespace Database\Factories;

use App\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Video::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => 'https://www.youtube.com/watch?v=ibgkLzQVgjo',
            'name' => $this->faker->text(rand(50, 150)),
        ];
    }
}
