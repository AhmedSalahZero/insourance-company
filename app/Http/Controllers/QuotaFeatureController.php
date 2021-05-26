<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Http\Resources\FeatureResource;
use App\Models\Feature;
use App\Models\Quota;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuotaFeatureController extends Controller
{
    public function index(Quota $quota)
    {
        return FeatureResource::collection($quota->features);
    }

    public function store(storeFeatureRequest $request , Quota $quota)
    {
        $quota->features()->save(
            Feature::make([
                'feature'=>$request->feature
            ])
        );

        return response()->json([
            'status'=>true  ,
            'message'=>'New Feature Has Been Added To ' . $quota->name . ' Quota'
        ] , 201 );
    }

    public function update(UpdateFeatureRequest $request , Quota $quota , Feature $feature)
    {

        $feature->update([
            'feature'=>$request->feature
        ]);

        return response()->json([
            'status'=>'success' ,
            'message'=>'Feature Has Been Updated For Quota ' . $quota->name
        ]);

    }

    public function destroy(Quota $quota , Feature $feature)
    {
        $feature->delete();

        return response()->json([
            'status'=>true  ,
            'message'=>'Feature Has Been Removed For ' . $quota->name ,
        ] , 201);

    }
}
