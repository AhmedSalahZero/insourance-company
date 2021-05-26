<?php

namespace Tests\Feature;


use App\Models\Car;
use App\Models\CarType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_requires_to_be_auth_to_show_cars()
    {
        $this->json('GET','/api/cars')->assertStatus(401);
    }

    public function test_it_shows_all_cars()
    {
        $user = User::factory()->create();

        $car = Car::factory()->create();




        $this->jsonAs($user , 'GET','/api/cars')->assertJsonFragment([
            $car->name ]
        );

    }

    public function test_it_store_a_car()
    {
        if($x > 5)
        {
            return bool ;
        }
        else{
            return 'ahmed';
        }
        $user = User::factory()->create();

        $car = Car::factory()->make() ;


        $this->jsonAs($user , 'POST','/api/cars' , $car->toArray())->assertStatus(201);

        $this->assertDatabaseCount('cars' , 1) ;

        $this->assertDatabaseHas('cars' , [
            'name'=>$car->name
        ]) ;

    }

    public function test_it_updates_a_car()
    {
        $user = User::factory()->create();

        $car = Car::factory()->create() ;

        $newData = ['name'=>'new car name' , 'logo'=>'123.jpg' ];

        $this->jsonAs($user , 'PUT','/api/cars/'.$car->id , $newData)->assertExactJson([
            'success'=>'Car Data Has Been Updated' ,
        ]);

        $this->assertDatabaseHas('cars' , $newData) ;


    }

    public function test_it_delete_a_car_with_its_type()
    {
        $user = User::factory()->create();

        $car = Car::factory()->create() ;

        $carType = CarType::factory()->create([
            'car_id'=>$car->id
        ]);

        $carType2 = CarType::factory()->create([
            'car_id'=>$car->id
        ]);


        $this->jsonAs($user , 'DELETE','/api/cars/'.$car->id )->assertExactJson([
            'success'=>'Car Has Been Deleted Successfully'
        ]);

        $this->assertDatabaseMissing('cars', [
            'name'=>$car->name
        ]);

        $this->assertDatabaseMissing('car_types',[
            'name'=>$carType->id
        ]);


        $this->assertDatabaseMissing('car_types',[
            'name'=>$carType2->id
        ]);



    }



}
