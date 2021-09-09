<?php

namespace App\Libraries\PokemonTranslator;

use App\Libraries\Pokemon\Pokemon;

abstract class PokemonTranslatorCreator
{
    abstract public function pokemonTranslationFactory(): PokemonTranslator;

    final public function translate(Pokemon $pokemon): Pokemon
    {
        $pokemonTranslator = $this->pokemonTranslationFactory();
        $trans = $pokemonTranslator->getTranslatedDescription($pokemon);
        return $pokemon->clone($trans);
    }
}
