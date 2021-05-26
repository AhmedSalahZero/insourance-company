<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service ;
use App\Http\Resources\ServiceTypeResource;

class ServicesServicesTypesController extends Controller
{

    public function __invoke(Service $service)
    {
        return ServiceTypeResource::collection($service->types);
    }
}
