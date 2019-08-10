<?php

namespace App\Events;

use App\Models\EmailNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EmailNotificationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $users;
    public $notification;

    /**
     * NotificationEmailCreated constructor.
     * @param $users
     * @param $notification
     */
    public function __construct($users, EmailNotification $notification)
    {
        $this->users = $users;
        $this->notification = $notification;
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
