<?php

namespace App\Libraries\Pokeball\PokeAPI;

use App\Libraries\MissingEnvException;
use App\Libraries\Pokeball\NoPokemonFoundException;
use Illuminate\Http\Client\Response;
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
        $response = $this->invokeServer($pokemonName, $urlToInvoke);
        return $response;
    }

    private function invokeServer(string $pokemonName, string $urlToInvoke): array
    {
        $response = Http::get($urlToInvoke);
        $this->ensureResponseIsSuccesfull($response, $pokemonName);
        return $response->json();
    }

    private function ensureResponseIsSuccesfull(Response $response, string $pokemonName): void
    {
        if ($response->successful()) {
            return;
        }
        switch ($response->status()) {
            case 404:
                throw new NoPokemonFoundException($pokemonName);
            default:
                $response->throw();
        }
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
