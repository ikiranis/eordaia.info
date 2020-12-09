<?php

namespace Database\Factories;

use App\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address,
            'email' => $this->faker->companyEmail,
            'valid_code' => Str::random(20),
            'bizcategory_id' => rand(0,2),
            'customer_id' => Str::random(20)
        ];
    }
}
