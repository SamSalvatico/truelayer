<?php

namespace App\Libraries\PokemonMaster;

use App\Libraries\Pokeball\Pokeball;
use App\Libraries\PokemonTranslator\PokemonTranslationChooser;

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
        $thePokemon = $this->pokeball->catchIt($pokemonName);
        $tranlatorCreator = PokemonTranslationChooser::getTranslator($thePokemon);
        $translatedPokemon = $tranlatorCreator->translate($thePokemon);
        return $translatedPokemon->toArray();
    }
}
