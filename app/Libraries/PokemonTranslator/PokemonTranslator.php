<?php

namespace App\Libraries\PokemonTranslator;

use App\Libraries\Pokemon\Pokemon;

interface PokemonTranslator
{
    public function getTranslatedDescription(Pokemon $pokemon): string;
}
