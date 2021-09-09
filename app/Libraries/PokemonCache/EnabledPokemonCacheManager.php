<?php

namespace App\Libraries\PokemonCache;

class EnabledPokemonCacheManager extends PokemonCacheManager
{
    private const ONE_HOUR = 60 * 60;

    protected function getTranslatedKeyTTL(): int
    {
        return self::ONE_HOUR;
    }

    protected function getBasicKeyTTL(): int
    {
        return self::ONE_HOUR;
    }
}
