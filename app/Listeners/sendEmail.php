<?php

namespace App\Listeners;

use App\Events\sendEmailAdmin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrechoMail;

class sendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  sendEmailAdmin  $event
     * @return void
     */
    public function handle(sendEmailAdmin $event)
    {
        Mail::send(new BrechoMail(2, []));
    }
}
