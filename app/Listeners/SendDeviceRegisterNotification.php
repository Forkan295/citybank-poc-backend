<?php

namespace App\Listeners;

use DarkGhostHunter\Larapass\Events\AttestationSuccessful;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDeviceRegisterNotification
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
     * @param AttestationSuccessful $event
     */
    public function handle(AttestationSuccessful $event)
    {
        return $event->user;
    }
}
