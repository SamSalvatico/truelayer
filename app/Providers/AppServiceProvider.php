<?php

namespace App\Providers;

use App\Libraries\Pokemon\BasicPokemon;
use App\Libraries\Pokemon\Pokemon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public array $bindings = [
        Pokemon::class => BasicPokemon::class,
    ];

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
        //
    }
}
