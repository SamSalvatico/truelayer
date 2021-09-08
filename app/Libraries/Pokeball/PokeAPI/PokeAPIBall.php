<?php

namespace App\Libraries\Pokeball\PokeAPI;

use App\Libraries\Pokeball\Pokeball;
use App\Libraries\Pokemon\Pokemon;

class PokeAPIBall implements Pokeball
{
    public function catchIt(string $pokemonName): Pokemon
    {
        $arrayedPokemon = PokeAPIHttpClient::getInstance()->catchIt($pokemonName);
        return PokeAPIParser::box($arrayedPokemon)->parse();
    }
}
