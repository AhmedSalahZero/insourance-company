<?php

namespace Tests\Feature;


use App\Models\LiabilityLimit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LiabilityLimitTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_must_be_auth_to_show_all_liability_limits()
    {
        $this->json('GET' , 'api/liabilityLimits')->assertStatus(401);
    }


    public function test_it_shows_all_liability_limits()
    {
        $user = User::factory()->create();

        $liabilityLimit = LiabilityLimit::factory()->create();
        $this->jsonAs($user , 'GET' , 'api/liabilityLimits' )->assertJsonFragment([
            'limit'=>$liabilityLimit->limit ,
            'price'=>$liabilityLimit->price
        ]);

    }

    public function test_it_stores_liability_limit()
    {
        $user = User::factory()->create();

        $liabilityLimit = LiabilityLimit::factory()->make();

        $this->jsonAs($user , 'POST' , 'api/liabilityLimits' , $liabilityLimit->toArray())->assertExactJson([
            'success'=>true ,
            'message'=>'Liability Limit Has Been Created Successfully' ,
        ])->assertStatus(201);

    }

    public function test_it_updates_liability_limit()
    {
        $user = User::factory()->create();

        $liabilityLimit = LiabilityLimit::factory()->create();

        $data = [
            'limit'=>'1 - 9 ' ,
            'price'=>170,
        ];

        $this->jsonAs($user , 'PUT' , 'api/liabilityLimits/'.$liabilityLimit->id , $data)->assertExactJson([
            'message'=>'Liability Limit Has Been Update Successfully ' ,
            'status'=>true ,
        ])->assertStatus(200);

        $this->assertDatabaseHas('liability_limits',$data);


    }

    public function test_it_deletes_liability_limit()
    {
        $user = User::factory()->create();

        $liabilityLimit = LiabilityLimit::factory()->create();

        $data = [
            'limit'=>'1 - 9 ' ,
            'price'=>170,
        ];

        $this->jsonAs($user , 'DELETE' , 'api/liabilityLimits/'.$liabilityLimit->id , $data);

        $this->assertDatabaseMissing('liability_limits',$data);


    }





}
