<?php

namespace App\Listeners;

use App\Events\RegisterEmployee;
use App\Mail\WelcomeEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{

    public function __construct()
    {

    }


    public function handle(RegisterEmployee $event)
    {
        Mail::to($event->employee->email)->send(new WelcomeEmail());
    }
}
