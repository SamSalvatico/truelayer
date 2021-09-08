<?php

namespace App\Libraries\PokemonMaster;

interface PokemonMaster
{
    public function getBasicInfo(string $pokemonName): array;

    public function getTranslatedInfo(string $pokemonName): array;
}
