<?php

namespace App\Providers;

use App\Events\GroupCreated;
use App\Events\GroupMembershipCreated;
use App\Events\ScoreEmailReceived;
use App\Events\UnverifiedGroupCreated;
use App\Listeners\RecordScoreFromEmail;
use App\Listeners\SendGroupCreationEmail;
use App\Listeners\SendGroupMembershipCreationEmail;
use App\Listeners\SendUnverifiedGroupCreationEmail;
use App\Listeners\SendUserVerificationEmail;
use App\Models\GroupMembership;
use App\Models\Score;
use App\Models\User;
use App\Observers\GroupMembershipObserver;
use App\Observers\ScoreObserver;
use App\Observers\UserObserver;
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
            SendUserVerificationEmail::class,
        ],
        UnverifiedGroupCreated::class => [
            SendUnverifiedGroupCreationEmail::class
        ],
        GroupCreated::class => [
            SendGroupCreationEmail::class
        ],
        GroupMembershipCreated::class => [
            SendGroupMembershipCreationEmail::class
        ],
        ScoreEmailReceived::class => [
            RecordScoreFromEmail::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Score::observe(ScoreObserver::class);
        GroupMembership::observe(GroupMembershipObserver::class);
        User::observe(UserObserver::class);
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
