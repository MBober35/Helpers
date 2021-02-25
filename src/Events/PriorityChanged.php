<?php

namespace MBober35\Helpers\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PriorityChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $table;
    /**
     * @var array
     */
    public $ids;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $table, array $ids)
    {
        $this->table = $table;
        $this->ids = $ids;
    }
}
