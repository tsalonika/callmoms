<?php

namespace App\Events;

use App\Models\Forum;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForumDiscussionSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(Forum $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new Channel('my-channel-forum');
    }

    public function broadcastAs()
    {
        return 'my-event-forum';
    }
}
