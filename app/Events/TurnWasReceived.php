<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TurnWasReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $turno;
    public $modulo;
    public $modulo_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($turno, $modulo, $modulo_id)
    {
        $this->turno = $turno;
        $this->modulo = $modulo;
        $this->modulo_id = $modulo_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */ 
    public function broadcastOn()
    {
        return new Channel('turn-channel');
    }
}
