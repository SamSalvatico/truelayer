<?php

namespace App\Libraries\PokemonCatcher\PokeAPI;

use App\Libraries\PokemonCatcher\PokemonCatcher;
use App\Libraries\Pokemon\Pokemon;

class PokeAPICatcher implements PokemonCatcher
{
    public function catchIt(string $pokemonName): Pokemon
    {
        $arrayedPokemon = PokeAPIHttpClient::getInstance()->catchIt($pokemonName);
        return PokeAPIParser::box($arrayedPokemon)->parse();
    }
}
