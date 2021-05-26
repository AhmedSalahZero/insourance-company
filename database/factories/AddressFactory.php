<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->address ,
            'govern'=>$this->faker->state ,
            'area'=>$this->faker->city ,
            'street'=>$this->faker->streetName ,
            'building'=>$this->faker->buildingNumber,
            'floor'=>$this->faker->numberBetween(0,20),
            'flat_number'=>$this->faker->numberBetween(0,5) . $this->faker->word
        ];
    }
    /* public function default()
    {
        return $this->state([
            'default'=>true , 
        ]);
    }
    public function secondary()
    {
        return $this->state([
            'default'=>false
        ]);
        
    } */
}
