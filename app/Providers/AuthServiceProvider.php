<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Realm' => 'App\Policies\RealmPolicy',
        'App\Models\Continent' => 'App\Policies\ContinentPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\Landscape' => 'App\Policies\LandscapePolicy',
        'App\Models\LargeCity' => 'App\Policies\LargeCityPolicy',
        'App\Models\MediumCity' => 'App\Policies\MediumCityPolicy',
        'App\Models\SmallCity' => 'App\Policies\SmallCityPolicy',
        'App\Models\Place' => 'App\Policies\PlacePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* VIEW GATES */
        Gate::define('view-realms', function($user){
            return $user->rank->id <= 2; //admin and mods can see realms
        });

        Gate::define('view-users', function($user){
            return $user->rank->id <= 2; //admin and mods can see users
        });

        /* EDIT GATES */
        Gate::define('edit-realm', function ($user, $realm) {
            return $user->id == $realm[0]->gamemaster->id || $user->isAdmin;
        });

        Gate::define('edit-continent', function ($oUser, $oContinent) {
            return $oUser->id == $oContinent[0]->realm[0]->gamemaster->id || $oUser->isAdmin;
        });
    }
}
