<?php

namespace App\Providers;

use App\Concerns\GetsUserGroupsWithRelationshipsLoaded;
use App\Concerns\GetsUsersInSharedGroupsWithAuthenticatedUser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(GetsUsersInSharedGroupsWithAuthenticatedUser::class, function ($app) {
            return new GetsUsersInSharedGroupsWithAuthenticatedUser();
        });
    }
}
