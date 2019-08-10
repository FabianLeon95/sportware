<?php

namespace App\Listeners;

use App\Events\EventWasCreated;
use App\Mail\SendEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEventNotification
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
     * @param object $event
     * @return void
     */
    public function handle(EventWasCreated $event)
    {
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user)->queue(new SendEmail($event, $user));
        }

    }
}
