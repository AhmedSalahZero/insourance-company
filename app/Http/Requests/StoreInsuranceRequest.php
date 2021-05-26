<?php

namespace App\Http\Requests;

use App\Rules\positiveNumberRule;
use App\Rules\UserOwnThisAddressRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'=>'required|exists:users,id',
            'address_id'=>['required','exists:addresses,id' , new UserOwnThisAddressRule() ] ,
            'company_id'=>'required|exists:companies,id',
            'service_id'=>'required|exists:services,id',
            'service_type_id'=>'required|exists:service_types,id' ,
            'price'=>['required','numeric',new positiveNumberRule() ] ,
            'car_id'=>'required_if:service_id,==,1|exists:cars,id',
            'car_type_id'=>'required_if:service_id,==,1|exists:car_types,id',
            'quota_id'=>'required_if:service_id,==,2|exists:quotas,id' ,
            'seats_no'=>['required_if:service_id,==,1','numeric',new positiveNumberRule()] ,
            'front_image'=>'required|image',
            'back_image'=>'required|image',
            'est_val'=>'required_if:service_id,==,1|numeric',
            'people_no'=>['required_if:service_id,==,1','numeric' , new positiveNumberRule()],
            'receiver_number'=>'required|numeric',
            'limit_id'=>'required_if:service_id,==,3|exists:liability_limits,id',
            'duration'=>['required_if:service_id==2','numeric',new positiveNumberRule() ],

        ];
    }
}
