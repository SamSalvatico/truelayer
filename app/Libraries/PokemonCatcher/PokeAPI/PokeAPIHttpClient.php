<?php

namespace App\Libraries\PokemonCatcher\PokeAPI;

use Illuminate\Support\Facades\Http;

class PokeAPIHttpClient
{
    private static ?self $currentInstance = null;
    private string $baseUrl;

    public static function getInstance()
    {
        if (empty($currentInstance)) {
            static::$currentInstance == new PokeAPIHttpClient(config('truelayer.poke_api_url'));
        }

        return static::$currentInstance;
    }

    private function __construct(string $baseUrl)
    {
        $this->baseUrl = trim($baseUrl, '/');
    }

    public function catchIt(string $pokemonName): array
    {
        $urlToInvoke = $this->preparePokeAPIUrlToInvoke($pokemonName);
        $response = $this->invokeServer($urlToInvoke);
        return $response;
    }

    private function invokeServer(string $urlToInvoke): array
    {
        $response = Http::get($urlToInvoke);
        return $response->json();
    }

    private function preparePokeAPIUrlToInvoke(string $pokemonName): string
    {
        $baseUrl = $this->baseUrl;
        return "$baseUrl/pokemon-species/$pokemonName";
    }
}
