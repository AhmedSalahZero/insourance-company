<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = Car::factory()->create([
            'name'=>'toyota'
        ]) ;

        CarType::factory()->count(2)->create([
            'car_id'=>$car->id ,
        ]);

        $car = Car::factory()->create([
            'name'=>'jeep'
        ]) ;

        CarType::factory()->count(2)->create([
            'car_id'=>$car->id ,
        ]);

    }
}
