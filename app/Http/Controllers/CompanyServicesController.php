<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Company ;
use App\Http\Resources\ServiceResource ;
use App\Http\Resources\CompanyResource ;

class CompanyServicesController extends Controller
{
    public function index(Company $company)
    {
        return ServiceResource::collection($company->services);
    }

    public function store( StoreCompanyServiceRequest $request,Company $company )
    {


        $company->services()->attach(
            $request->service_id ,[
                'price_from'=>$request->price_from ,
                'price_to'=>$request->price_to
            ]
        );

        return response()->json([
            'status'=>true ,
            'message'=>'service Has Been Added For This Company '
        ],201);

    }

    public function destroy(Company $company , Service $service)
    {
        $company->services()->detach($service->id);

        return response()->json([
            'status'=>true ,
            'message'=>'Service Has Been Deleted From This Company Successfully' ,

        ]);
    }

    public function deleteAll(Company $company)
    {
        $company->services()->detach();

        return response()->json([
            'status'=>true ,
            'message'=>'Services For This Company Has Been Deleted Successfully' ,

        ]);
    }
}

