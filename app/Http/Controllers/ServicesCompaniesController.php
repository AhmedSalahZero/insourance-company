<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service ;
use App\Http\Resources\CompanyResource;

class ServicesCompaniesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Service $service)
    {
        return CompanyResource::collection($service->companies);
    }
    
}
