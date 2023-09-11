<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StartChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $sender;
    public $reciver;
    public function __construct($sender , $reciver)
    {
        $this->sender = $sender;
        $this->reciver = $reciver;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('start.chat.with.'.$this->reciver);
    }

    public function broadcastAs()
    {
        return 'start.chat';
    }

    public function boardcastWith()
    {
        return [
            'message'=>'New Message Sent',
            'data'=>['sender'=>$this->sender,'reciver'=>$this->reciver]
        ];
    }
}
