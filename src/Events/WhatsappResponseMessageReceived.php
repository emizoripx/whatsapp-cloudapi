<?php

namespace EmizorIpx\WhatsappCloudapi\Events;

use EmizorIpx\WhatsappCloudapi\Response\CallbackResponse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WhatsappResponseMessageReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callback_response;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( CallbackResponse $callback_response )
    {
        $this->callback_response = $callback_response;
    }

}

