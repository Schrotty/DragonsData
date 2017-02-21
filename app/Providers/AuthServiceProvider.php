<?php

namespace App\Providers;

use App\Models\Continent;
use App\Models\Island;
use App\Models\Landscape;
use App\Models\Ocean;
use App\Models\Realm;
use App\Models\Sea;
use App\Policies\ContinentPolicy;
use App\Policies\IslandPolicy;
use App\Policies\LandscapePolicy;
use App\Policies\OceanPolicy;
use App\Policies\Policy;
use App\Policies\RealmPolicy;
use App\Policies\SeaPolicy;
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
        Continent::class => ContinentPolicy::class,
        Ocean::class => OceanPolicy::class,
        Landscape::class => LandscapePolicy::class,
        Sea::class => SeaPolicy::class,
        Island::class => IslandPolicy::class
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
