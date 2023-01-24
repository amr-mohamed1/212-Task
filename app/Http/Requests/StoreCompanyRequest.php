<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
//          'name'          => 'required|unique:companies|max:100|min:2',
            'name'          => 'required|max:100|min:2',
            'address'       => 'required|max:255',
        ];
    }
}
