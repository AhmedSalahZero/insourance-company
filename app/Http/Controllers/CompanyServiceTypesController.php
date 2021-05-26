<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyServiceTypeRequest;
use App\Http\Resources\ServiceTypeResource;
use App\Models\Company;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class CompanyServiceTypesController extends Controller
{
    public function index(Company $company)
    {
        return ServiceTypeResource::collection($company->servicesType);
    }

    public function store(StoreCompanyServiceTypeRequest $request,Company $company )
    {

        $company->servicesType()->attach( $request->input('serviceType_id') , [
            'price'=>$request->price
        ] );

        return response()->json([
            'status'=>true ,
            'message'=>'service Type Has Been Added For This Company '
        ],201);

    }

    public function destroy(Company $company , ServiceType $serviceType)
    {
        $company->servicesType()->detach($serviceType->id);

        return response()->json([
            'status'=>true ,
            'message'=>'Service Type Has Been Deleted From This Company Successfully' ,
        ]);

    }

    public function deleteAll(Company $company)
    {
        $company->servicesType()->detach();

        return response()->json([
            'status'=>true ,
            'message'=>'Services Type For This Company Has Been Deleted Successfully' ,

        ]);
    }
}
