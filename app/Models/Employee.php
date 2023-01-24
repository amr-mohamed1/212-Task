<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'email',
        'password',
        'company_id',
        'image',
    ];

    public function Company(){
        return $this->belongsTo(Company::class);
    }
}
