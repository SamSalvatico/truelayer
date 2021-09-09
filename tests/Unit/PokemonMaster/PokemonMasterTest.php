<?php

namespace Tests\Unit\PokemonMaster;

use App\Libraries\Pokeball\NoPokemonFoundException;
use App\Libraries\PokemonMaster\PokemonMaster;
use App\Libraries\PokemonTranslator\FunnyTranslator\FunnyRateException;
use Tests\TestCase;
use Tests\GeneralPokemonStub;

class PokemonMasterTest extends TestCase
{
    private PokemonMaster $master;

    protected function setUp(): void
    {
        parent::setUp();
        $this->master = app(PokemonMaster::class);
    }

    public function testBasicWorksFineIfCorrectResponse(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasic('mewtwo', true, 'forest');

        $infos = $this->master->getBasicInfo('mewtwo');

        $this->assertArrayHasKey('name', $infos);
        $this->assertArrayHasKey('description', $infos);
        $this->assertArrayHasKey('isLegendary', $infos);
        $this->assertArrayHasKey('habitat', $infos);
        $this->assertEquals('mewtwo', $infos['name']);
        $this->assertEquals(true, $infos['isLegendary']);
        $this->assertEquals('forest', $infos['habitat']);
    }

    public function testBasicThrowsExcepionIfNotFound(): void
    {
        $this->expectException(NoPokemonFoundException::class);

        GeneralPokemonStub::stubNOTValidResponsesForBasic();

        $this->master->getBasicInfo('mewtwo');
    }

    public function testTranslatedWorksFineIfCorrectResponse(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasicAndTranslations('mewtwo', true, 'forest');

        $infos = $this->master->getTranslatedInfo('mewtwo');

        $this->assertArrayHasKey('name', $infos);
        $this->assertArrayHasKey('description', $infos);
        $this->assertArrayHasKey('isLegendary', $infos);
        $this->assertArrayHasKey('habitat', $infos);
        $this->assertEquals('mewtwo', $infos['name']);
        $this->assertEquals(true, $infos['isLegendary']);
        $this->assertEquals('forest', $infos['habitat']);
        $this->assertEquals(GeneralPokemonStub::getValidTranslatedDescription(), $infos['description']);
    }

    public function testTranslatedThrowsExceptionIfBasicNotFound(): void
    {
        $this->expectException(NoPokemonFoundException::class);

        GeneralPokemonStub::stubNOTValidResponsesForBasic();

        $this->master->getTranslatedInfo('mewtwo');
    }

    public function testTranslatedStillReturnsValidInfosIfTranslationNotFound(): void
    {
        GeneralPokemonStub::stubNOTValidResponsesForBasicAndTranslations(
            200,
            GeneralPokemonStub::getValidPokeAPIResponseBody('mewtwo', true, 'forest'),
            404,
            []
        );

        $infos = $this->master->getTranslatedInfo('mewtwo');

        $this->assertArrayHasKey('name', $infos);
        $this->assertArrayHasKey('description', $infos);
        $this->assertArrayHasKey('isLegendary', $infos);
        $this->assertArrayHasKey('habitat', $infos);
        $this->assertEquals('mewtwo', $infos['name']);
        $this->assertEquals(true, $infos['isLegendary']);
        $this->assertEquals('forest', $infos['habitat']);
    }

    public function testTranslatedThrowsExceptionIfRateIsOver(): void
    {
        $this->expectException(FunnyRateException::class);

        GeneralPokemonStub::stubNOTValidResponsesForBasicAndTranslations(
            200,
            GeneralPokemonStub::getValidPokeAPIResponseBody('mewtwo', true, 'forest'),
            429,
            ['error' => ['message' => "RATE"]]
        );

        $this->master->getTranslatedInfo('mewtwo');
    }
}
