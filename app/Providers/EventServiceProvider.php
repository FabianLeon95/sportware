<?php

namespace App\Providers;

use App\Events\EmailNotificationCreated;
use App\Events\EventWasCreated;
use App\Events\UserWasCreated;
use App\Listeners\SendCompleteRegistrationEmail;
use App\Listeners\SendEmailNotification;
use App\Listeners\SendEventNotification;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        Registered::class => [
//            SendEmailVerificationNotification::class,
//        ],
        EventWasCreated::class => [
            SendEventNotification::class
        ],
        UserWasCreated::class => [
           SendCompleteRegistrationEmail::class
        ],
        EmailNotificationCreated::class => [
            SendEmailNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
