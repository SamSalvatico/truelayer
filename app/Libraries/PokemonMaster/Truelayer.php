<?php

namespace App\Libraries\PokemonMaster;

use App\Libraries\Pokeball\Pokeball;

class TrueLayer implements PokemonMaster
{
    private Pokeball $pokeball;

    public function __construct(Pokeball $pokeball)
    {
        $this->pokeball = $pokeball;
    }

    public function getBasicInfo(string $pokemonName): array
    {
        $thePokemon = $this->pokeball->catchIt($pokemonName);
        return $thePokemon->toArray();
    }

    public function getTranslatedInfo(string $pokemonName): array
    {
        return [];
    }
}
