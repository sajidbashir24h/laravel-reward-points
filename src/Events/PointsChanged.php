<?php

namespace Sajidbashir24h\Gamify\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PointsChanged implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    /**
     * @var Model
     */
    public $subject;

    /**
     * @var int
     */
    public $point;

    /**
     * @var bool
     */
    public $increment;

    /**
     * Create a new event instance.
     *
     * @param $subject
     * @param $point integer
     * @param $increment
     */
    public function __construct(Model $subject, int $point, bool $increment)
    {
        $this->subject = $subject;
        $this->point = $point;
        $this->increment = $increment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|\Illuminate\Broadcasting\Channel[]
     */
    public function broadcastOn()
    {
        $channelName = config('gamify.channel_name') . $this->subject->getKey();

        if (config('gamify.broadcast_on_private_channel')) {
            return new PrivateChannel($channelName);
        }

        return new Channel($channelName);
    }
}
