<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User ;
use App\Models\ServiceType ;
use App\Models\Service ;
use App\Models\Company ;

class ServiceTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_must_be_auth_to_show_services_type()
    {
         $this->json('GET','/api/serviceType')->assertStatus(401);
    }

    public function test_it_shows_all_type_services()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $serviceType2 = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

         $this->jsonAs($user , 'GET','/api/serviceType')->assertJsonFragment([
                'name'=>$serviceType->name
         ] , [
            'name'=>$serviceType2->name
         ]);

    }

    public function test_it_store_service_type()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();



         $this->jsonAs($user , 'POST','/api/serviceType' ,[
             'name'=>'service type name' ,
             'service_id'=>$service->id
         ])->assertJsonFragment([
                'name'=>'service type name'
         ] );

    }

    public function test_it_update_service_type()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

         $this->jsonAs($user , 'PUT','/api/serviceType/'.$serviceType->id ,[
             'name'=>'service type name' ,
             'service_id'=>$service->id
         ])->assertJsonFragment([
                'name'=>'service type name'
         ] );

    }

    public function test_it_removes_service_type()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $this->assertDataBaseHas('service_types',[
            'name'=>$serviceType->name
        ]);

         $this->jsonAs($user , 'DELETE','/api/serviceType/'.$serviceType->id );

         $this->assertDataBaseMissing('service_types',[
             'name'=>$serviceType->name
         ]);

    }

    public function test_it_returns_companies_for_a_service_type()
    {
        $user = User::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $company = Company::factory()->create();

        $company2 = Company::Factory()->create();

        $serviceType->companies()->attach([$company->id , $company2->id] , [
            'price'=>100
        ]);

        $this->jsonAs($user,'GET','api/services-types/'.$serviceType->id . '/companies')->assertJsonFragment([
            'name'=>$company->name
        ],[
            'name'=>$company2->name
        ]);
    }

}
