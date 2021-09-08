<?php

namespace App\Libraries\Pokeball;

use App\Libraries\Pokemon\Pokemon;

interface Pokeball
{
    public function catchIt(string $pokemonName): Pokemon;
}
