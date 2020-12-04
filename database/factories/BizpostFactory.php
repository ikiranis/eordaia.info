<?php

namespace Database\Factories;

use App\Bizpost;
use Illuminate\Database\Eloquent\Factories\Factory;
use \DavidBadura\FakerMarkdownGenerator\FakerProvider;
use Str;

class BizpostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bizpost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));

        return [
            'title' => $this->faker->sentence(15),
            'body' => $this->faker->markdown(),
            'activated' => true,
            'validated' => true,
            'valid_code' => Str::random(20),
            'kind' => 0,
            'due_date' => $this->faker->dateTimeBetween('now', '1 month')->format('Y-m-d'),
        ];
    }
}
