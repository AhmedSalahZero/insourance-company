<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiabilityLimitRequest;
use App\Http\Requests\UpdateLiabilityLimitRequest;
use App\Http\Resources\LiabilityLimitResource;
use App\Models\LiabilityLimit;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LiabilityLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return LiabilityLimitResource::collection(LiabilityLimit::all());
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

    public function store(StoreLiabilityLimitRequest $request)
    {
        LiabilityLimit::create(
            $request->only(['limit','price'])
        );

        return response()->json([
            'success'=>true ,
            'message'=>'Liability Limit Has Been Created Successfully' ,
        ] , 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LiabilityLimit  $liabilityLimit
     * @return \Illuminate\Http\Response
     */
    public function show(LiabilityLimit $liabilityLimit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LiabilityLimit  $liabilityLimit
     * @return \Illuminate\Http\Response
     */
    public function edit(LiabilityLimit $liabilityLimit)
    {
        //
    }


    public function update(UpdateLiabilityLimitRequest $request, LiabilityLimit $liabilityLimit)
    {
        $liabilityLimit->update(
            $request->only(['limit','price'])
        );

        return response()->json([
            'message'=>'Liability Limit Has Been Update Successfully ' ,
            'status'=>true ,
        ]);

    }


    public function destroy(LiabilityLimit $liabilityLimit)
    {
        $liabilityLimit->delete();

        return response()->json([
            'message'=>'Liability Limit Has Been Deleted Successfully' ,
            'status'=>true ,

        ]);
    }
}
