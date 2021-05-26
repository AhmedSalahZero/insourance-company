<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Resources\AddressResource ; 
use App\Http\Requests\updateAddressRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AddressResource::collection(Auth()->user()->addresses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        
        $address = Address::create(array_merge(
            $request->only(['name','govern','area','street','building','floor','flat_number']),[
                 'user_id'=>$request->user()->id
                 ]));
                 
        return new AddressResource($address);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(updateAddressRequest $request, Address $address)
    {
        
        $addressFields = array_filter($request->only(['name','govern','area','street','building','floor','flat_number']) , function($item){
            return $item != null ;
        }) ;
        if($addressFields)
        {
            $address->update($addressFields);
            return response()->json([
                'status'=>true , 
                'message'=>trans('lang.record has been updated successfully')
            ],200);
        }
        return response()->json([
            'status'=>false , 
            'message'=>trans('lang.record has not been updated')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->delete();

        return response()->json([
            'status'=>true , 
            'message'=>trans('lang.record has been deleted successfully')
        ] , 200 ) ;
    }
}
