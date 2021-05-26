<?php

namespace Database\Seeders;

use App\Models\LiabilityLimit;
use Illuminate\Database\Seeder;
use App\Models\Company ;
use App\Models\Service ;
use App\Models\ServiceType ;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CarSeeder::class);
        $this->call(LiabilityLimitSeeder::class);
        $this->call(QuotaSeeder::class);

        $companies = Company::factory()->count(2)->create()->each(function($comp){

            $services = Service::factory(2)->create()->each(function($service) use ($comp){

                $comp->services()->attach($service->id,[
                    'price_from'=> 1000 ,
                    'price_to'=>2000,
                ]) ;

                ServiceType::factory(2)->create(['service_id'=>$service->id ])->each(function($serviceType) use ($service ,$comp){

                    $service->types()->save($serviceType ) ;

                    $comp->servicesType()->attach($serviceType->id ,[
                        'price'=>100
                    ]);
                });
            });
        });
        // \App\Models\User::factory(10)->create();
    }
}
