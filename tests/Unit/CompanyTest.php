<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Company ;
use App\Models\Service ;
use App\Models\ServiceType ;

class CompanyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_many_services()
    {
        $company = Company::factory()->create();

        $service1 = Service::factory()->create();

        $service2 = Service::factory()->create();

        $company->services()->attach([$service1->id , $service2->id] , [
            'price_from'=> 100  ,
            'price_to'=>200
        ]);

        $this->assertInstanceOf(Service::class , $company->services()->first()) ;

    }
    public function test_it_has_return_valid_services_number()
    {
        $company = Company::factory()->create();

        $service1 = Service::factory()->create();

        $service2 = Service::factory()->create();

        $company->services()->attach([$service1->id , $service2->id] , [
            'price_from'=> 100  ,
            'price_to'=>200
        ]);

        $this->assertEquals(2, $company->countServices()) ;
    }

    public function test_it_has_many_services_types()
    {
        $company = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType1 = ServiceType::factory()->create([
            'service_id'=>$service->id ,

        ]);

        $serviceType2 = ServiceType::factory()->create([
            'service_id'=>$service->id,

        ]);

        $company->servicesType()->attach([$serviceType1->id , $serviceType2->id] ,[
            'price'=>100
        ]);

        $this->assertInstanceOf(ServiceType::class , $company->servicesType()->first()) ;

    }

}
