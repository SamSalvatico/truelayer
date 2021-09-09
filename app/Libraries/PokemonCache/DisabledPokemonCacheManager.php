<?php

namespace App\Libraries\PokemonCache;

class DisabledPokemonCacheManager extends PokemonCacheManager
{

    protected function getTranslatedKeyTTL(): int
    {
        return 0;
    }

    protected function getBasicKeyTTL(): int
    {
        return 0;
    }
}
