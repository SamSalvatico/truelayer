<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

class ShakespeareTranslator extends FunnyTranslator
{
    protected function getEndpointSuffix(): string
    {
        return 'shakespeare';
    }
}
