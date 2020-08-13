<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class recievemessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id,$from_id,$to_id,$username,$photouser,$message,$photos,$created_at;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $from_id,$to_id,$username,$photouser,$message,$photos,$created_at)
    {
        //
        $this->id=$id;
        $this->from_id=$from_id;
        $this->to_id=$to_id;
        $this->username=$username;
        $this->photouser=$photouser;
        $this->message=$message;
        $this->photos=$photos;
        $this->created_at=$created_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('recieve.'.$this->to_id);
    }
}
