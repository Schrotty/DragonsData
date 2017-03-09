<?php

namespace App\Providers;

use App\Models\Biome;
use App\Models\City;
use App\Models\Continent;
use App\Models\Empire;
use App\Models\Island;
use App\Models\Lake;
use App\Models\Landmark;
use App\Models\Landscape;
use App\Models\Mountain;
use App\Models\Ocean;
use App\Models\Realm;
use App\Models\River;
use App\Models\Sea;
use App\Models\User;
use App\Policies\BiomePolicy;
use App\Policies\CityPolicy;
use App\Policies\ContinentPolicy;
use App\Policies\EmpirePolicy;
use App\Policies\IslandPolicy;
use App\Policies\LakePolicy;
use App\Policies\LandmarkPolicy;
use App\Policies\LandscapePolicy;
use App\Policies\MountainPolicy;
use App\Policies\OceanPolicy;
use App\Policies\Policy;
use App\Policies\RealmPolicy;
use App\Policies\RiverPolicy;
use App\Policies\SeaPolicy;
use App\Policies\UserPolicy;
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
        Island::class => IslandPolicy::class,
        City::class => CityPolicy::class,
        River::class => RiverPolicy::class,
        Lake::class => LakePolicy::class,
        Biome::class => BiomePolicy::class,
        Landmark::class => LandmarkPolicy::class,
        Mountain::class => MountainPolicy::class,
        Empire::class => EmpirePolicy::class,
        User::class => UserPolicy::class
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
