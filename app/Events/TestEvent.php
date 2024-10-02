<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $name; // 名前属性を追加してみる。

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $name) // 文字列で名前を受け取る
    {
        $this->name = $name; // 名前属性にセット
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
