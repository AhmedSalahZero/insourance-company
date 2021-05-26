<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarTypeRequest;
use App\Http\Requests\UpdateCarTypeRequest;
use App\Http\Resources\CarTypesResource;
use App\Models\CarType;
use Illuminate\Http\Request;

class CarTypeController extends Controller
{

    public function index()
    {
        return CarTypesResource::collection(CarType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function store(StoreCarTypeRequest $request)
    {
        $carType = $request->only(['name','car_id' , 'year']);

        CarType::create($carType);

        return response()->json([
            'success'=>'Car Type Has Been Added Successfully ' ,

        ] , 201 );

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function show(CarType $carType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarType  $carType
     * @return \Illuminate\Http\Response
     */
    public function edit(CarType $carType)
    {
        //
    }

    public function update(UpdateCarTypeRequest $request, CarType $carType)
    {
        $carType->update(
            $request->only(['name','car_id','year'])
        );

        return response()->json([
            'success'=>'Car Type Has Been Updated Successfully'
        ]);


    }


    public function destroy(CarType $carType)
    {
        $carType->delete();

        return response()->json([
            'success'=>'Cart Type Has Been Deleted Successfully' ,
        ]);

    }
}
