<?php

namespace App\Listeners;

use App\Events\EmailNotificationCreated;
use App\Mail\SendNotificationEmail;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EmailNotificationCreated $event)
    {
        foreach ($event->users as $user) {
            Mail::to($user)->queue(new SendNotificationEmail($event->notification));
        }
    }
}
