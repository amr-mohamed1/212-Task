<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'          => 'required|max:100|min:2',
//          'email'       => 'required|unique:employees',
            'email'         => 'required',
            'password'      => 'required|min:8',
            'company'       => 'required',
        ];
    }
}
