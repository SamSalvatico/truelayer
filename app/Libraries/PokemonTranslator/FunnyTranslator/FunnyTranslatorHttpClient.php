<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

use App\Libraries\MissingEnvException;
use App\Libraries\Pokeball\NoPokemonFoundException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FunnyTranslatorHttpClient
{
    private string $endpointSuffix;
    private string $baseUrl;

    public function __construct(string $endpointSuffix)
    {
        $this->endpointSuffix  = $endpointSuffix;
        $this->baseUrl = trim($this->ensureBaseUrlIsSet(), '/');
    }

    public function translateIt(string $description): array
    {
        $urlToInvoke = $this->prepareFunnyUrl($description);
        $response = $this->invokeServer($description, $urlToInvoke);
        return $response;
    }

    private function invokeServer(string $description, string $urlToInvoke): array
    {
        $response = Http::get($urlToInvoke);
        $this->ensureResponseIsSuccesfull($response, $description);
        return $response->json();
    }

    private function ensureResponseIsSuccesfull(Response $response, string $pokemonName): void
    {
        if ($response->successful()) {
            return;
        }
        switch ($response->status()) {
            default:
                $response->throw();
        }
    }

    private function prepareFunnyUrl(string $description): string
    {
        $baseUrl = $this->baseUrl;
        $endpointSuffix = $this->endpointSuffix;
        if (!str_ends_with($endpointSuffix, ".json")) {
            $endpointSuffix .= ".json";
        }
        $description = urlencode($description);
        return "$baseUrl/$endpointSuffix?text=$description";
    }

    /**
     * @throws MissingEnvException
     */
    private function ensureBaseUrlIsSet(): string
    {
        $funnyApiUrl = config('truelayer.funny_api_url');
        if (isset($funnyApiUrl)) {
            return $funnyApiUrl;
        }

        throw new MissingEnvException("The configuration value 'truelayer.funny_api_url' is missing");
    }
}
