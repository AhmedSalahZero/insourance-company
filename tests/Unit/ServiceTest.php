<?php

namespace Tests\Unit;

use Tests\TestCase ; 
use App\Models\Service ; 
use App\Models\ServiceType ;
use App\Models\User ; 
use App\Models\Company ;

class ServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_many_types()
    {
        $service = Service::factory()->create();

        $type = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $type2 = ServiceType::factory()->create([
            'service_id'=>$service->id
        ]);

        $this->assertInstanceOf(ServiceType::class ,$service->types->first());
    }

    public function test_it_belongs_to_many_companies()
    {
        $company1 = Company::factory()->create();

        
        $company2 = Company::factory()->create();


        $service = Service::factory()->create();

        $service->companies()->attach([$company1->id , $company2->id],[
            'price_from'=>150 , 
            'price_to'=>270
        ]);
        
        $this->assertInstanceOf(Company::class ,$service->companies->first());
    }

}
