<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Http\Resources\CarTypesResource;
use Illuminate\Http\Request;
use App\Models\Car ;

class CarCarsTypesController extends Controller
{

    public function __invoke(Car $car)
    {
        return CarTypesResource::collection($car->types)->additional([
            'car'=>new CarResource($car)
        ]);

    }

}
