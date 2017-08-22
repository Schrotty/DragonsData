<?php

namespace App\Providers;

use App\Item;
use App\News;
use App\Policies\ItemPolicy;
use App\Policies\NewsPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        News::class => NewsPolicy::class,
        User::class => UserPolicy::class,
        Item::class => ItemPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
