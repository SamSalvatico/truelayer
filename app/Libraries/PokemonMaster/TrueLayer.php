<?php

namespace App\Libraries\PokemonMaster;

use App\Libraries\Pokeball\Pokeball;
use App\Libraries\Pokemon\Pokemon;
use App\Libraries\PokemonCache\PokemonCache;
use App\Libraries\PokemonTranslator\PokemonTranslationChooser;

class TrueLayer implements PokemonMaster
{
    private Pokeball $pokeball;
    private PokemonCache $pokemonCache;

    public function __construct(Pokeball $pokeball, PokemonCache $pokemonCache)
    {
        $this->pokeball = $pokeball;
        $this->pokemonCache = $pokemonCache;
    }

    public function getBasicInfo(string $pokemonName): array
    {
        return $this->getBasicPokemon($pokemonName)->toArray();
    }

    private function getBasicPokemon(string $pokemonName): Pokemon
    {
        $pokeball = $this->pokeball;
        return $this->pokemonCache->basic($pokemonName, function () use ($pokeball, $pokemonName) {
            return $pokeball->catchIt($pokemonName);
        });
    }

    public function getTranslatedInfo(string $pokemonName): array
    {
        $translatedPokemon = $this->pokemonCache->translated($pokemonName, function () use ($pokemonName) {
            $thePokemon = $this->getBasicPokemon($pokemonName);
            $tranlatorCreator = PokemonTranslationChooser::getTranslator($thePokemon);
            return $tranlatorCreator->translate($thePokemon);
        });

        return $translatedPokemon->toArray();
    }
}
