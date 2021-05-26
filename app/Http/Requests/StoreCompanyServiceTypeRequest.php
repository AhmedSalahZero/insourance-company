<?php

namespace App\Http\Requests;

use App\Rules\positiveNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyServiceTypeRequest extends FormRequest
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
            'serviceType_id'=>'required|exists:service_types,id',
            'price'=>['required','numeric' , new positiveNumberRule() ] ,

        ];
    }
}
