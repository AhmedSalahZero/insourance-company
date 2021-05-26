<?php

namespace App\Observers;
use App\Models\Car ;

class CarObserver
{
    public function deleting(Car $car)
    {
        $car->types()->delete();
    }
}
