<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ;
use App\Http\Resources\UserResource ;
use App\Http\Requests\RegisterRequest ;
class RegisterController extends Controller
{

    public function __invoke(RegisterRequest $request)
    {

        $user = $request->only(['name','email','phone','password']) ;


        return new UserResource(User::create($user));

    }
}
