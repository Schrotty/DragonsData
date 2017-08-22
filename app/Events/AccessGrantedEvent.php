<?php

namespace App\Events;

use App\Item;
use App\News;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AccessGrantedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $item;
    public $subscriber;

    /**
     * Create a new event instance.
     *
     * @param News $news
     */
    public function __construct(Item $item, $subscriber)
    {
        $this->item = $item;
        $this->subscriber = $subscriber;
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
