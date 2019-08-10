<?php

namespace App\Mail;

use App\Events\EventWasCreated;
use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $event;
    protected $user;

    /**
     * SendEmail constructor.
     * @param EventWasCreated $event
     * @param User $user
     */
    public function __construct(EventWasCreated $event,User $user)
    {
        $this->event = $event;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // TODO: sleep
        sleep(5);
        return $this->view('emails.event',['event' => $this->event->event, 'user' => $this->user]);
    }
}
