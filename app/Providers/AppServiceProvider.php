<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\Quota;
use App\Observers\CarObserver;
use App\Observers\QuotaObserver;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Address  ;
use App\Observers\AddressObserver;
use App\Observers\CompanyObserver;
use App\Models\Company  ;
use App\Observers\ServiceObserver;
use App\Models\Service  ;
use App\Models\ServiceType;
use App\Observers\ServiceTypeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Address::observe(AddressObserver::class);
        Company::observe(CompanyObserver::class);
        Service::observe(ServiceObserver::class);
        ServiceType::observe(ServiceTypeObserver::class);
        Car::observe(CarObserver::class);
        Quota::observe(QuotaObserver::class);


    }
}
