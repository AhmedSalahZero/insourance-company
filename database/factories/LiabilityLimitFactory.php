<?php

namespace Database\Factories;

use App\Models\LiabilityLimit;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiabilityLimitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LiabilityLimit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'limit'=>$this->faker->numberBetween(1,4) . '-' . $this->faker->numberBetween(5,10),
            'price'=>$this->faker->numberBetween(100,600)
        ];
    }
}
