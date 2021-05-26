<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest ; 
use App\Http\Resources\userResource ;
class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
       
         $token = Auth('api')->attempt($request->only(['email','password'])) ; 

         if($token){
             
            return (new userResource($request->user()))
            ->additional([

                'token'=>$token 
                
                ]);
            }

         return response()->json([
             'status'=>false 
         ],422);

    }
}
