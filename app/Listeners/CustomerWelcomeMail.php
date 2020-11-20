<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;
use App\Mail\WelcomeCustomer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class CustomerWelcomeMail implements ShouldQueue
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
     * @param  CustomerRegistered  $event
     * @return void
     */
    public function handle(CustomerRegistered $event)
    {
        // Mail::to($event->customer)->send(new WelcomeCustomer($event->customer));
    }
}
