<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreAddressRequest extends FormRequest
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
           'name'=>'string|max:255',

           'govern'=>'required|string|max:255',

           'area'=>'required|string|max:255',

           'street'=>'string|max:255',

           'building'=>'string|max:255',

           'floor'=>['numeric','min:0','max:200'],

           'flat_number'=>'string|max:255',
           
           
        ];
    }
}
