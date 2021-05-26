<?php

namespace Tests\Unit;

use Tests\TestCase ;
use App\Models\Company ;
use App\Models\Service ;
use App\Models\ServiceType ;

class ServiceTypeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_belongs_to_many_companies()
    {
        $company1 = Company::Factory()->create();

        $company2 = Company::factory()->create();

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $serviceType->companies()->attach([$company1->id , $company2->id] , [
            'price'=>200
        ]);

        $this->assertInstanceOf(Company::class , $serviceType->companies->first());

    }

    public function test_it_belongs_to_one_service()
    {

        $service = Service::factory()->create();

        $serviceType = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $this->assertInstanceOf(Service::class , $serviceType->Service);

    }

}
