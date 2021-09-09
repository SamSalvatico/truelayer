<?php

namespace Tests\Feature;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\GeneralPokemonStub;
use Tests\TestCase;

class PokemonControllerTest extends TestCase
{
    public function testBasicPokemonWorksFine(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasic('pikachu');

        $response = $this->get('/pokemon/pikachu');

        Http::assertSent(function (Request $request) {
            return str_contains($request->url(), config('truelayer.poke_api_url'));
        });

        Http::assertNotSent(function (Request $request) {
            return str_contains($request->url(), config('truelayer.funny_api_url'));
        });

        $response->assertStatus(200);
    }

    public function testBasicHasValidBody(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasic('pikachu');

        $response = $this->get('/pokemon/pikachu');
        $body = $response->json();

        $this->assertArrayHasKey('name', $body);
        $this->assertArrayHasKey('description', $body);
        $this->assertArrayHasKey('isLegendary', $body);
        $this->assertArrayHasKey('habitat', $body);
    }

    public function testBasicIfNoPokemonNameIsSetReturns404(): void
    {

        $response = $this->get('/pokemon');

        $response->assertStatus(404);
        Http::assertNothingSent();
    }

    public function testTranslatedIfNoPokemonNameIsSetReturns404(): void
    {
        GeneralPokemonStub::stubNOTValidResponsesForBasic();

        $response = $this->get('/pokemon/translated/');

        $response->assertStatus(404);
    }

    public function testTranslatedPokemonWorksFine(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasicAndTranslations('pikachu');

        $response = $this->get('/pokemon/translated/pikachu');

        Http::assertSent(function (Request $request) {
            return str_contains($request->url(), config('truelayer.poke_api_url'));
        });

        Http::assertSent(function (Request $request) {
            return str_contains($request->url(), config('truelayer.funny_api_url'));
        });

        $response->assertStatus(200);
    }

    public function testTranslatedHasValidBody(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasicAndTranslations('pikachu');

        $response = $this->get('/pokemon/translated/pikachu');
        $body = $response->json();

        $this->assertArrayHasKey('name', $body);
        $this->assertArrayHasKey('description', $body);
        $this->assertArrayHasKey('isLegendary', $body);
        $this->assertArrayHasKey('habitat', $body);
    }

    public function testBasicPokemonReturnNotFoundIfPokemonDoesNotExist(): void
    {
        GeneralPokemonStub::stubNOTValidResponsesForBasic();

        $response = $this->get('/pokemon/pikachu');

        $response->assertStatus(404);
    }

    public function testTranslatedPokemonIsReturnedWithDescriptionIfTransNotFound(): void
    {
        GeneralPokemonStub::stubNOTValidResponsesForBasicAndTranslations(
            200,
            GeneralPokemonStub::getValidPokeAPIResponseBody('pikachu'),
            404,
            []
        );

        $response = $this->get('/pokemon/translated/pikachu');
        $body = $response->json();

        $response->assertSuccessful();

        $this->assertArrayHasKey('name', $body);
        $this->assertArrayHasKey('description', $body);
        $this->assertArrayHasKey('isLegendary', $body);
        $this->assertArrayHasKey('habitat', $body);
    }

    public function testTranslatedPokemonReturns429IfRateExceeded(): void
    {
        GeneralPokemonStub::stubNOTValidResponsesForBasicAndTranslations(
            200,
            GeneralPokemonStub::getValidPokeAPIResponseBody('pikachu'),
            429,
            ['error' => ['message' => "RATE"]]
        );

        $response = $this->get('/pokemon/translated/pikachu');

        $response->assertStatus(429);
    }
}
