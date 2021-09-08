<?php

namespace App\Libraries\PokemonCatcher;

use App\Libraries\Pokemon\Pokemon;

interface PokemonCatcher
{
    public function catchIt(string $pokemonName): Pokemon;
}
