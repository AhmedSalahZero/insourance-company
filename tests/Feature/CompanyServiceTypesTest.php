<?php

namespace Tests\Feature;


use App\Models\Company;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyServiceTypesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_get_all_services_types_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $company->servicesType()->attach($serviceType->id ,[
            'price'=>100
        ]);

        $this->jsonAs($user,'GET','/api/companies/'.$company->id.'/services-types')->assertJsonFragment([
            'name'=>$serviceType->name ,

        ]);
    }

    public function test_it_attach_service_type_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

         $this->jsonAs($user,'POST','/api/companies/'.$company->id.'/services-types',[
            'serviceType_id'=>$serviceType->id ,
             'price'=>100
        ])->assertJsonFragment([
             'status'=>true ,
             'message'=>'service Type Has Been Added For This Company '
        ])->assertStatus(201);
       $this->assertDatabaseHas('company_service_type' , [
           'service_type_id'=>$serviceType->id ,
           'company_id'=>$company->id ,
           'price'=>100

       ]);
    }

    public function test_it_detach_service_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $company->servicesType()->attach($serviceType->id , [
            'price'=>400
        ]);


        $response = $this->jsonAs($user,'DELETE','/api/companies/'.$company->id.'/services-types/'.$serviceType->id)->assertJsonFragment([
            'status'=>true ,
            'message'=>'Service Type Has Been Deleted From This Company Successfully' ,
        ])->assertStatus(200);
        $this->assertDatabaseMissing('company_service_type' , [
            'service_type_id'=>$serviceType->id ,
            'company_id'=>$company->id ,
            'price'=>400
        ]);
    }

    public function test_it_detach_all_service_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);
        $company->servicesType()->attach($serviceType->id , [
            'price'=>800
        ]);


        $response = $this->jsonAs($user,'DELETE','/api/companies/'.$company->id.'/services-types/')->assertJsonFragment([
            'status'=>true ,
            'message'=>'Services Type For This Company Has Been Deleted Successfully' ,
        ])->assertStatus(200);
        $this->assertDatabaseMissing('company_service_type' , [
            'service_type_id'=>$serviceType->id ,
            'company_id'=>$company->id ,

        ]);
    }


}
