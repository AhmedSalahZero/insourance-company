<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\CarType;
use Tests\TestCase;


class CarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_car_has_many_types()
    {
        $car = Car::factory()->create();

        $carType = CarType::factory()->count(2)->create([
            'car_id'=>$car->id
        ]);

        $this->assertInstanceOf(CarType::class , $car->types->first());

    }


}
