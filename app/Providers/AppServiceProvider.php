<?php

namespace App\Providers;

use App\Mail\WelcomeEmail;
use App\Models\Employee;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //
    }


    public function boot()
    {

    }
}
