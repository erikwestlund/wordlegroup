<?php

namespace App\Providers;

use App\Events\GroupCreated;
use App\Events\GroupMembershipCreated;
use App\Events\UnverifiedGroupCreated;
use App\Listeners\SendGroupCreationEmail;
use App\Listeners\SendGroupMembershipCreationEmail;
use App\Listeners\SendUnverifiedGroupCreationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UnverifiedGroupCreated::class => [
            SendUnverifiedGroupCreationEmail::class
        ],
        GroupCreated::class => [
            SendGroupCreationEmail::class
        ],
        GroupMembershipCreated::class => [
            SendGroupMembershipCreationEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
