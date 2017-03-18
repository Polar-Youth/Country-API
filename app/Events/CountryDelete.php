<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class CountryDelete
 *
 * @package App\Events
 */
class CountryDelete
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $country;

    /**
     * Create a new event instance.
     *
     * @param  $country
     * @return void
     */
    public function __construct($country)
    {
        $this->country = $country;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
