<?php

namespace App\Libraries\PokemonCache;

use App\Libraries\Pokemon\Pokemon;
use Closure;

interface PokemonCache
{
    public function basic(string $pokemonName, Closure $howToGetPokemon): Pokemon;

    public function translated(string $pokemonName, Closure $howToGetTranslatedPokemon): Pokemon;
}
