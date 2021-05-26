<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource ;
use App\Models\ServiceType;

class ServicesTypesCompaniesController extends Controller
{

    public function __invoke(ServiceType $serviceType)
    {
        return CompanyResource::collection( $serviceType->companies );
    }
}
