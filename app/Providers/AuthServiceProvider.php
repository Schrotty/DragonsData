<?php

namespace App\Providers;

use App\Category;
use App\Item;
use App\Journal;
use App\News;
use App\Party;
use App\Policies\ItemPolicy;
use App\Policies\JournalPolicy;
use App\Policies\MetaPolicy;
use App\Policies\NewsPolicy;
use App\Policies\PartyPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\UserPolicy;
use App\Property;
use App\Settings;
use App\Tag;
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
        Item::class => ItemPolicy::class,
        Party::class => PartyPolicy::class,
        Journal::class => JournalPolicy::class,
        Settings::class => SettingsPolicy::class,

        /* META POLICIES */
        Category::class => MetaPolicy::class,
        Tag::class => MetaPolicy::class,
        Property::class => MetaPolicy::class
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
