<?php

namespace App\Libraries\Pokeball\PokeAPI;

use App\Libraries\MissingEnvException;
use Illuminate\Support\Facades\Http;

class PokeAPIHttpClient
{
    private static ?self $currentInstance = null;
    private string $baseUrl;

    public static function getInstance(): PokeAPIHttpClient
    {
        if (empty($currentInstance)) {
            static::$currentInstance = new PokeAPIHttpClient(static::ensureBaseUrlIsSet());
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
        return "$baseUrl/pokemon-species/$pokemonName/";
    }

    /**
     * @throws MissingEnvException
     */
    private static function ensureBaseUrlIsSet(): string
    {
        $pokeApiUrl = config('truelayer.poke_api_url');
        if (isset($pokeApiUrl)) {
            return $pokeApiUrl;
        }

        throw new MissingEnvException("The configuration value 'truelayer.poke_api_url' is missing");
    }
}
