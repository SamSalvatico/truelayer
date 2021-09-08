<?php

namespace App\Http\Controllers;

use App\Libraries\PokemonMaster\PokemonMaster;
use Illuminate\Http\JsonResponse;

class PokemonController extends Controller
{
    private PokemonMaster $pokemonMaster;

    public function __construct(PokemonMaster $pokemonMaster)
    {
        $this->pokemonMaster = $pokemonMaster;
    }

    public function basic(string $name): JsonResponse
    {
        return response()->json(
            $this->pokemonMaster->getBasicInfo($name)
        );
    }

    public function translated(string $name): JsonResponse
    {
        return response()->json(
            $this->pokemonMaster->getTranslatedInfo($name)
        );
    }
}
