<?php

namespace App\Libraries\PokemonTranslator;

use App\Libraries\Pokemon\Pokemon;
use App\Libraries\PokemonTranslator\FunnyTranslator\ShakespeareTranslatorCreator;
use App\Libraries\PokemonTranslator\FunnyTranslator\YodaTranslatorCreator;

final class PokemonTranslationChooser
{
    public static function getTranslator(Pokemon $pokemon): PokemonTranslatorCreator
    {
        if (self::isTheForceWithYou($pokemon)) {
            return new YodaTranslatorCreator();
        }
        return new ShakespeareTranslatorCreator();
    }

    private static function isTheForceWithYou(Pokemon $pokemon): bool
    {
        return ($pokemon->isLegendary() || $pokemon->habitat() == 'cave');
    }
}
