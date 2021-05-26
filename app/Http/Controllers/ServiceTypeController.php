<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceTypeRequest;
use App\Models\User ;
use App\Http\Requests\updateServiceTypeRequest;
use App\Http\Resources\ServiceTypeResource;

class ServiceTypeController extends Controller
{

    public function index()
    {
        return ServiceTypeResource::collection(ServiceType::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(StoreServiceTypeRequest $request)
    {
        $serviceType = ServiceType::create($request->only(['name','service_id']));

        return new ServiceTypeResource($serviceType);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceType $serviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceType $serviceType)
    {
        //
    }


    public function update(updateServiceTypeRequest $request, ServiceType $serviceType)
    {

        $serviceType->update($request->only(['name','service_id']));


        return new ServiceTypeResource($serviceType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceType  $serviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceType $serviceType)
    {

        $serviceType->delete();

        return response()->json([
            'status'=>true ,
            'message'=>'Record Has Been Deleted Successfully',
        ] , 200 );
    }
}
