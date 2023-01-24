<?php

namespace App\Traits;

use http\Env\Request;

trait UploadImages
{
    public function upload_img($req,$input_name,$folder){
        $img = $req->file($input_name)->getClientOriginalName();
        $final_name = rand(1,1000) . $img;
        $path = $req->file($input_name)->storeAs($folder,$final_name,'public');
        return $path;
    }
}
