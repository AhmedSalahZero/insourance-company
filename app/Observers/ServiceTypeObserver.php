<?php

namespace App\Observers;
use App\Models\ServiceType ;
use App\Models\Company ; 
class ServiceTypeObserver
{
    public function deleting(ServiceType $serviceType)
    {
        $serviceType->companies()->detach();
        
    }
}
