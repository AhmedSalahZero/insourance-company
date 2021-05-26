<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class updateAddressRequest extends FormRequest
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
            'name'=>'max:255',
 
            'govern'=>'string|max:255',
 
            'area'=>'string|max:255',
 
            'street'=>'string|max:255',
 
            'building'=>'string|max:255',
 
            'floor'=>['numeric','min:0','max:200'],
 
            'flat_number'=>'string|max:255',
            
            
         ];
    }
}
