<?php

namespace App\Providers;

use App\Libraries\Pokemon\BasicPokemon;
use App\Libraries\Pokemon\Pokemon;
use App\Libraries\PokemonMaster\PokemonMaster;
use App\Libraries\Pokeball\PokeAPI\PokeAPIBall;
use App\Libraries\Pokeball\Pokeball;
use App\Libraries\PokemonCache\DisabledPokemonCacheManager;
use App\Libraries\PokemonCache\EnabledPokemonCacheManager;
use App\Libraries\PokemonCache\PokemonCache;
use App\Libraries\PokemonMaster\TrueLayer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public array $bindings = [
        Pokemon::class => BasicPokemon::class,
        Pokeball::class => PokeAPIBall::class,
        PokemonMaster::class => TrueLayer::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('truelayer.is_pokemon_cache_enabled')) {
            $this->app->bind(PokemonCache::class, EnabledPokemonCacheManager::class);
        } else {
            $this->app->bind(PokemonCache::class, DisabledPokemonCacheManager::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
