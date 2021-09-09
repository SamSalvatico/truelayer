<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

use App\Libraries\Pokemon\Pokemon;
use App\Libraries\PokemonTranslator\PokemonTranslator;

abstract class FunnyTranslator implements PokemonTranslator
{
    final public function getTranslatedDescription(Pokemon $pokemon): string
    {
        $httpClient = $this->getHttpClient();
        $translatedArray = $httpClient->translateIt($pokemon->description());
        return FunnyTranslationParser::box($translatedArray)->getTranslatedText();
    }

    final public function getHttpClient(): FunnyTranslatorHttpClient
    {
        return new FunnyTranslatorHttpClient($this->getEndpointSuffix());
    }

    abstract protected function getEndpointSuffix(): string;
}
