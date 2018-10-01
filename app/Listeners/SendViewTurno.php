<?php

namespace App\Listeners;

use App\Events\TurnWasReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendViewTurno
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
     * @param  TurnWasReceived  $event
     * @return void
     */
    public function handle(TurnWasReceived $event)
    {
        //
    }
}
