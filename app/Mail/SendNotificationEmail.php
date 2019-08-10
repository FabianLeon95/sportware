<?php

namespace App\Mail;

use App\Models\EmailNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $notification;

    /**
     * SendNotificationEmail constructor.
     *
     * @param EmailNotification $notification
     */
    public function __construct(EmailNotification $notification)
    {
        $this->notification = $notification;
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
        return $this->subject($this->notification->subject)
                    ->view('emails.notification', ['notification' => $this->notification]);
    }
}
