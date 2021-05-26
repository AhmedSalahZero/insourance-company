<?php

namespace App\Observers;
use App\Models\Service ; 

class ServiceObserver
{
    public function deleting(Service $service)
    {
        $service->types->each(function($serviceType){
            $serviceType->companies()->detach();
        });
        
        $service->types()->delete();

        $service->companies()->detach();
        
    }
}
