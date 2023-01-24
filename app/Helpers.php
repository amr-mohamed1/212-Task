<?php

use App\Models\Company;
use App\Models\Employee;

function get_company_name($id){
    return $id;
    $data = Company::find($id);
    if($data){
        return $data->name;
    }
    return null;
}
function get_companies(){
    $data = Company::all();
    return $data;
}
