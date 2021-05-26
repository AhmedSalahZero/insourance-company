<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User ;
use App\Models\Service ;
use App\Models\ServiceType ;
use App\Models\Company ;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_must_be_auth_to_store_service()
    {
        $response = $this->json('POST','/api/services' , [
            'name'=>'service1'
        ])->assertStatus(401);
        //$response->assertStatus(200);
    }

    public function test_it_store_service()
    {
        $user = User::factory()->create();

        $this->jsonAs($user , 'POST' , '/api/services' , [
            'name'=>'my service'
        ])->assertJsonFragment([
            'name'=>'my service'
        ]);

    }

    public function test_it_requires_name_to_store_service()
    {
        $user = User::factory()->create();

        $this->jsonAs($user , 'POST' , '/api/services' )->assertJsonValidationErrors([
            'name'
        ]);

    }

    public function test_it_requires_unique_name_to_store_service()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $this->jsonAs($user , 'POST' , '/api/services' ,[
            'name'=>$service->name
        ])->assertJsonValidationErrors(['name']);

    }

    public function test_it_update_service()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $this->jsonAs($user , 'PUT' , '/api/services/'.$service->id, [
            'name'=>'new name'
        ])->assertJsonFragment([
            'name'=>'new name'
        ]);


    }

    public function test_it_delete_service()
    {
        $user = User::Factory()->create();

        $service = Service::factory()->create();


        $servicesType = ServiceType::factory()->count(2)->create([
            'service_id'=>$service->id
        ]);

        $company = Company::Factory()->create();

        $company->services()->attach($service->id , [
            'price_from'=>100 ,
            'price_to'=>200
        ]);

        $company->servicesType()->attach($servicesType->pluck('id'),[
            'price'=>100
        ]);

        $this->jsonAs($user , 'DELETE' , '/api/services/'.$service->id )->assertJsonFragment([
            'status'=>true ,
            'message'=>'Record Has Been Deleted Successfully' ,
        ]);

    }

    public function test_it_get_services_type_for_service()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $serviceType2 = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);


        $this->jsonAs($user,'GET' , '/api/services/'.$service->id.'/services-types' )->assertJsonFragment([
            'name'=>$serviceType->name ,
            'service'=>[
                'id'=>$service->id ,
                'name'=>$service->name
            ]
        ]  ,
        [
            'name'=>$serviceType2->name ,
            'service'=>[
                'id'=>$service->id ,
                'name'=>$service->name
            ]

        ]
    );


    }

    public function test_it_get_companies_for_service()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $company = Company::factory()->Create();

        $company2 = Company::factory()->Create();

        $service->companies()->attach([$company->id ,$company2->id ] , [
            'price_from'=> 100 ,
            'price_to'=>200
        ]);


        $this->jsonAs($user,'GET' , '/api/services/'.$service->id.'/companies' )->assertJsonFragment([
            'name'=> $company->name ,

        ]  ,
        [
            'name'=>$company->name ,


        ]
    );


    }



}
