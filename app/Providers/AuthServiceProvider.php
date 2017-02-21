<?php

namespace App\Providers;

use App\Models\Continent;
use App\Models\Realm;
use App\Policies\ContinentPolicy;
use App\Policies\Policy;
use App\Policies\RealmPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Model::class        => Policy::class,
        Realm::class        => RealmPolicy::class,
        Continent::class    => ContinentPolicy::class
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
