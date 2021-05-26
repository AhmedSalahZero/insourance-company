<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User ;
use Illuminate\Http\UploadedFile ;
use App\Models\Company ;
use App\Models\Service ;
use App\Models\ServiceType ;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_requires_auth_to_store_company()
    {

        $response = $this->json('post' , 'api/companies' )->assertStatus(401);
    }

    public function test_it_requires_name_to_store_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'email'=>'ahmed@yahoo.com'
        ])->assertJsonValidationErrors('name');
    }

    public function test_it_requires_email_to_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'name'=>'ahmed'
        ])->assertJsonValidationErrors('email');
    }

    public function test_it_requires_phone_to_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'name'=>'ahmed'
        ])->assertJsonValidationErrors('phone');
    }

    public function test_it_requires_address_to_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'name'=>'ahmed'
        ])->assertJsonValidationErrors('address');
    }

    public function test_it_requires_description_to_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'name'=>'ahmed'
        ])->assertJsonValidationErrors('description');
    }

    public function test_it_requires_logo_to_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies' ,[
            'name'=>'ahmed'
        ])->assertJsonValidationErrors('logo');
    }

    public function test_it_store_a_company()
    {
        $user = User::factory()->create();
        $response = $this->jsonAs($user , 'post' , 'api/companies/',[
            'name'=>'tailors' ,
            'email'=>'xyz@yahoo.com',
            'phone'=>'01025554120',
            'address'=>'123'  ,
            'description'=>'lol',
            'logo'=>'xyz.jpg'
        ])->assertJsonFragment([
            'name'=>'tailors' ,
            'email'=>'xyz@yahoo.com',
            'phone'=>'01025554120',
            'address'=>'123'  ,
            'description'=>'lol',
            'logo'=>'xyz.jpg'
        ]);

    }

    public function test_it_update_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $response = $this->jsonAs($user , 'put' , 'api/companies/'.$company->id ,[
            'name'=>'tailors' ,
            'email'=>'xyz@yahoo.com',
            'phone'=>'01025554120',
            'address'=>'123'  ,
            'description'=>'lol',
            'logo'=>'xyz.jpg'
        ])->assertJsonFragment([
            'name'=>'tailors' ,
            'email'=>'xyz@yahoo.com',
            'phone'=>'01025554120',
            'address'=>'123'  ,
            'description'=>'lol',
            'logo'=>'xyz.jpg'
        ]);

    }

    public function test_it_returns_services_for_an_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $service1 = Service::factory()->create();
        $service2 = Service::factory()->create();
        $company->services()->attach([$service1->id , $service2->id] , [
            'price_from'=> 10 ,
            'price_to'=>20
        ]);

        $this->jsonAs($user , 'GET',"api/companies/$company->id/services")->assertJsonFragment([
            'id'=>$service1->id ,
            'name'=>$service1->name
        ]);
    }

    public function test_it_returns_services_types_for_an_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $service = Service::factory()->create();
        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $serviceType2 = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $company->servicesType()->attach([$serviceType->id , $serviceType2->id],[
            'price'=>200
        ]);

        $this->jsonAs($user , 'GET',"api/companies/$company->id/services-types")->assertJsonFragment([
            'id'=>$serviceType->id ,
            'name'=>$serviceType->name ,
            'service'=>[
                'id'=>$service->id ,
                'name'=>$service->name
            ]
        ] ,
        [
            'id'=>$serviceType2->id ,
            'name'=>$serviceType2->name ,
            'service'=>[
                'id'=>$service->id ,
                'name'=>$service->name
            ]
        ]

    );

    }






}
