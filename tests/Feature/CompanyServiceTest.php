<?php

namespace Tests\Feature;


use App\Models\Company;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_get_all_services_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $company->services()->attach($service->id , [
            'price_from'=>100 ,
            'price_to'=>200
        ]);

        $response = $this->jsonAs($user,'GET','/api/companies/'.$company->id.'/services')->assertJsonFragment([
            'name'=>$service->name ,
            'price_from'=>100 ,
            'price_to'=>200
        ]);

        $response->assertStatus(200);
    }

    public function test_it_attach_services_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

         $this->jsonAs($user,'POST','/api/companies/'.$company->id.'/services',[
            'service_id'=>$service->id ,
            'price_from'=>100 ,
            'price_to'=>200
        ])->assertJsonFragment([
            'status'=>true ,
            'message'=>'service Has Been Added For This Company '
        ])->assertStatus(201);
       $this->assertDatabaseHas('company_service' , [
           'service_id'=>$service->id ,
           'company_id'=>$company->id ,
           'price_from'=>100 ,
           'price_to'=>200
       ]);
    }

    public function test_it_detach_service_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $company->services()->attach($service->id , [
            'price_from'=>100 ,
            'price_to'=>200
        ]);


        $response = $this->jsonAs($user,'DELETE','/api/companies/'.$company->id.'/services/'.$service->id)->assertJsonFragment([
            'status'=>true ,
            'message'=>'Service Has Been Deleted From This Company Successfully' ,
        ])->assertStatus(200);
        $this->assertDatabaseMissing('company_service' , [
            'service_id'=>$service->id ,
            'company_id'=>$company->id ,
            'price_from'=>100 ,
            'price_to'=>200
        ]);
    }

    public function test_it_detach_all_service_for_this_company()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $company->services()->attach($service->id , [
            'price_from'=>100 ,
            'price_to'=>200
        ]);


        $response = $this->jsonAs($user,'DELETE','/api/companies/'.$company->id.'/services/')->assertJsonFragment([
            'status'=>true ,
            'message'=>'Services For This Company Has Been Deleted Successfully' ,
        ])->assertStatus(200);
        $this->assertDatabaseMissing('company_service' , [
            'service_id'=>$service->id ,
            'company_id'=>$company->id ,
            'price_from'=>100 ,
            'price_to'=>200
        ]);
    }


}
