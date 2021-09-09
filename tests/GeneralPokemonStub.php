<?php

namespace Tests;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;

class GeneralPokemonStub
{
    public static function getValidPokeAPIResponseBody(
        string $pokemonName,
        bool $isLegendary = false,
        ?string $habitat = null
    ): array {
        if (!is_null($habitat)) {
            $habitat = ['name' => $habitat];
        }
        return [
            'id' => 413,
            'name' => $pokemonName,
            'order' => 441,
            'gender_rate' => 8,
            'capture_rate' => 45,
            'base_happiness' => 70,
            'is_baby' => false,
            'is_legendary' => $isLegendary,
            'is_mythical' => false,
            'hatch_counter' => 15,
            'has_gender_differences' => false,
            'forms_switchable' => false,
            'growth_rate' => [
                'name' => 'medium',
                'url' => 'https://pokeapi.co/api/v2/growth-rate/2/',
            ],
            'pokedex_numbers' => [
                0 => [
                    'entry_number' => 45,
                    'pokedex' => [
                        'name' => 'kalos-central',
                        'url' => 'https://pokeapi.co/api/v2/pokedex/12/',
                    ],
                ],
            ],
            'egg_groups' => [
                0 => [
                    'name' => 'bug',
                    'url' => 'https://pokeapi.co/api/v2/egg-group/3/',
                ],
            ],
            'color' => [
                'name' => 'gray',
                'url' => 'https://pokeapi.co/api/v2/pokemon-color/4/',
            ],
            'shape' => [
                'name' => 'squiggle',
                'url' => 'https://pokeapi.co/api/v2/pokemon-shape/2/',
            ],
            'evolves_from_species' => [
                'name' => 'burmy',
                'url' => 'https://pokeapi.co/api/v2/pokemon-species/412/',
            ],
            'evolution_chain' => [
                'url' => 'https://pokeapi.co/api/v2/evolution-chain/213/',
            ],
            'habitat' => $habitat,
            'generation' => [
                'name' => 'generation-iv',
                'url' => 'https://pokeapi.co/api/v2/generation/4/',
            ],
            'names' => [
                0 => [
                    'name' => 'Wormadam',
                    'language' => [
                        'name' => 'en',
                        'url' => 'https://pokeapi.co/api/v2/language/9/',
                    ],
                ],
            ],
            'flavor_text_entries' => [
                0 => [
                    'flavor_text' => self::getValidDescription(),
                    'language' => [
                        'name' => 'en',
                        'url' => 'https://pokeapi.co/api/v2/language/9/',
                    ],
                    'version' => [
                        'name' => 'red',
                        'url' => 'https://pokeapi.co/api/v2/version/1/',
                    ],
                ],
            ],
            'form_descriptions' => [
                0 => [
                    'description' => "abc",
                    'language' => [
                        'name' => 'en',
                        'url' => 'https://pokeapi.co/api/v2/language/9/',
                    ],
                ],
            ],
            'genera' => [
                0 => [
                    'genus' => 'Bagworm',
                    'language' => [
                        'name' => 'en',
                        'url' => 'https://pokeapi.co/api/v2/language/9/',
                    ],
                ],
            ],
            'varieties' => [
                0 => [
                    'is_default' => true,
                    'pokemon' => [
                        'name' => 'wormadam-plant',
                        'url' => 'https://pokeapi.co/api/v2/pokemon/413/',
                    ],
                ],
            ],
        ];
    }

    public static function getValidDescription(): string
    {
        $str = 'When the bulb on
        its back grows
        large, it appearsto lose the
        ability to stand
        on its hind legs.';
        return $str;
    }

    public static function getValidTranslationResponseBody(): array
    {
        return [
            'success' => [
                'total' => 1,
            ],
            'contents' => [
                'translated' => self::getValidTranslatedDescription(),
                'text' => 'Master Obiwan has lost a planet.',
                'translation' => 'yoda',
            ],
        ];
    }

    public static function getValidTranslatedDescription(): string
    {
        return 'Lost a planet,  master obiwan has.';
    }

    public static function stubValidResponsesForBasicAndTranslations(
        string $pokemonName,
        bool $isLegendary = false,
        ?string $habitat = null
    ): void {
        $responsesArray = [];
        self::pushValidPokeAPIResponse($responsesArray, $pokemonName, $isLegendary, $habitat);
        self::pushValidFunTransAPIResponse($responsesArray);
        self::stubResponses($responsesArray);
    }

    public static function stubValidResponsesForTranslations(): void
    {
        $responsesArray = [];
        self::pushValidFunTransAPIResponse($responsesArray);
        self::stubResponses($responsesArray);
    }

    public static function stubValidResponsesForBasic(
        string $pokemonName,
        bool $isLegendary = false,
        ?string $habitat = null
    ): void {
        $responsesArray = [];
        self::pushValidPokeAPIResponse($responsesArray, $pokemonName, $isLegendary, $habitat);
        self::stubResponses($responsesArray);
    }

    public static function stubNOTValidResponsesForBasicAndTranslations(
        int $basicStatus,
        array $basicBody,
        int $transStatus,
        array $transBody,
    ): void {
        $responsesArray = [];
        self::pushNOTValidPokeAPIResponse($responsesArray, $basicStatus, $basicBody);
        self::pushNOTValidFunTranslationAPIResponse($responsesArray, $transStatus, $transBody);
        self::stubResponses($responsesArray);
    }

    public static function stubNOTValidResponsesForBasic(
        int $statusCode = 404,
        array $body = []
    ): void {
        $responsesArray = [];
        self::pushNOTValidPokeAPIResponse($responsesArray, $statusCode, $body);
        self::stubResponses($responsesArray);
    }

    public static function stubNOTValidResponsesForTranslations(
        int $statusCode = 404,
        array $body = []
    ): void {
        $responsesArray = [];
        self::pushNOTValidFunTranslationAPIResponse($responsesArray, $statusCode, $body);
        self::stubResponses($responsesArray);
    }

    private static function pushValidPokeAPIResponse(
        array &$responsesArray,
        string $pokemonName,
        bool $isLegendary = false,
        ?string $habitat = null,
    ): void {
        $responsesArray[(config('truelayer.poke_api_url') . '*')] =
            self::getValidPokeAPIResponse($pokemonName, $isLegendary, $habitat);
    }

    private static function pushNOTValidPokeAPIResponse(
        array &$responsesArray,
        int $statusCode = 404,
        array $body = []
    ): void {
        $responsesArray[(config('truelayer.poke_api_url') . '*')] =
            Http::response($body, $statusCode);
    }

    private static function pushNOTValidFunTranslationAPIResponse(
        array &$responsesArray,
        int $statusCode = 404,
        array $body = []
    ): void {
        $responsesArray[(config('truelayer.funny_api_url') . '*')] =
            Http::response($body, $statusCode);
    }

    private static function pushValidFunTransAPIResponse(
        array &$responsesArray
    ): void {
        $responsesArray[(config('truelayer.funny_api_url') . '*')] =
            self::getValidFunTransResponse();
    }

    private static function stubResponses(array $responsesArray): void
    {
        Http::fake($responsesArray);
    }

    public static function getValidPokeAPIResponse(
        string $pokemonName,
        bool $isLegendary = false,
        ?string $habitat = null
    ): PromiseInterface {
        return Http::response(
            self::getValidPokeAPIResponseBody($pokemonName, $isLegendary, $habitat),
            200
        );
    }

    public static function getValidFunTransResponse(): PromiseInterface
    {
        return Http::response(
            self::getValidTranslationResponseBody(),
            200
        );
    }
}
