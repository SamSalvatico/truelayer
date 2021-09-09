<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

use App\Libraries\PokemonTranslator\PokemonTranslator;
use App\Libraries\PokemonTranslator\PokemonTranslatorCreator;

class ShakespeareTranslatorCreator extends PokemonTranslatorCreator
{
    public function pokemonTranslationFactory(): PokemonTranslator
    {
        return new ShakespeareTranslator();
    }
}
