<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuotaRequest;
use App\Http\Requests\UpdateQuotaRequest;
use App\Http\Resources\QuotaResource;
use App\Models\Quota;
use Illuminate\Http\Request;

class QuotaController extends Controller
{

    public function index()
    {
        return QuotaResource::collection(
            Quota::all()
        );

    }



    public function store(StoreQuotaRequest $request)
    {


        $quota = Quota::create($request->only(['name','price']));

        return response()->json([
            'status'=>true ,
            'message'=>'Quota ' .$quota->name. ' Has Been Added Successfully'
        ] , 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quota  $quota
     * @return \Illuminate\Http\Response
     */
    public function show(Quota $quota)
    {

    }



    public function update(UpdateQuotaRequest $request, Quota $quota)
    {
        $quota->update(
            $request->only(['name','price'])
        );

        return response()->json([
            'status'=>true ,
            'message'=>'Quota ' . $quota->name . ' Has Been Updated Successfully'
        ]);


    }

    public function destroy(Quota $quota)
    {
        $quota->delete();

        return response()->json([
            'status'=>true ,
            'message'=>'Quota Has Been Deleted Successfully'
        ]);
    }
}
