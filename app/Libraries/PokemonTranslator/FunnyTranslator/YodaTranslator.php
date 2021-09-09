<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

class YodaTranslator extends FunnyTranslator
{
    protected function getEndpointSuffix(): string
    {
        return 'yoda';
    }
}
