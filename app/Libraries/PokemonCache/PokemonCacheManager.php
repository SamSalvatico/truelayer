<?php

namespace App\Libraries\PokemonCache;

use App\Libraries\Pokemon\Pokemon;
use Closure;
use Illuminate\Support\Facades\Cache;

abstract class PokemonCacheManager implements PokemonCache
{
    final public function basic(string $pokemonName, Closure $howToGetPokemon): Pokemon
    {
        return Cache::remember(
            $this->getBasicKey($pokemonName),
            $this->getBasicKeyTTL(),
            $howToGetPokemon
        );
    }

    final public function translated(string $pokemonName, Closure $howToGetTranslatedPokemon): Pokemon
    {
        return Cache::remember(
            $this->getTranslatedKey($pokemonName),
            $this->getTranslatedKeyTTL(),
            $howToGetTranslatedPokemon
        );
    }

    final public function getTranslatedKey(string $pokemon): string
    {
        return "POKEMON_TRANSLATED_$pokemon";
    }

    final public function getBasicKey(string $pokemon): string
    {
        return "POKEMON_BASIC_$pokemon";
    }

    abstract protected function getTranslatedKeyTTL(): int;
    abstract protected function getBasicKeyTTL(): int;
}
