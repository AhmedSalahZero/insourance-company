<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Resources\CarResource ;
use App\Http\Requests\StoreCarRequest;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarResource::collection(Car::all());
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


    public function store(StoreCarRequest $request)
    {
        $car = $request->only(['name','logo']);

        Car::create($car);

        return response()->json([
            'success'=>'Car Has Been Added Successfully'
        ] , 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    public function update(UpdateCarRequest $request, Car $car)
    {

        $car->update(
            $request->only(['name','logo'])
        );

        return response()->json([
            'success'=>'Car Data Has Been Updated' ,
        ]);

    }


    public function destroy(Car $car)
    {

        $car->delete();

        return response()->json([
            'success'=>'Car Has Been Deleted Successfully'
        ] , 200 );

    }
}
