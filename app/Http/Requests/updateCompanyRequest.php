<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateCompanyRequest extends FormRequest
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
            'phone'=>'max:255',
            'email'=>'unique:companies,email|max:255',
            'address'=>'max:255',
            'logo'=>'max:255',
            'description'=>'max:500',
        ];
    }
}
