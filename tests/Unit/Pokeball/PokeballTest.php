<?php

namespace Tests\Unit\Pokeball;

use App\Libraries\Pokeball\NoPokemonFoundException;
use App\Libraries\Pokeball\Pokeball;
use App\Libraries\PokemonMaster\PokemonMaster;
use App\Libraries\PokemonTranslator\FunnyTranslator\FunnyRateException;
use Tests\TestCase;
use Tests\GeneralPokemonStub;

class PokeballTest extends TestCase
{
    private Pokeball $pokeball;

    protected function setUp(): void
    {
        parent::setUp();
        $this->pokeball = app(Pokeball::class);
    }

    public function testCatchItWorksFineIfResponseIsValid(): void
    {
        GeneralPokemonStub::stubValidResponsesForBasic('mewtwo', true, 'forest');

        $infos = $this->pokeball->catchIt('mewtwo');

        $this->assertEquals('mewtwo', $infos->name());
        $this->assertEquals(true, $infos->isLegendary());
        $this->assertEquals('forest', $infos->habitat());
        $this->assertStringContainsString('grows', $infos->description());
    }

    public function testCatchItThrowsExceptionIfNotFound(): void
    {
        $this->expectException(NoPokemonFoundException::class);

        GeneralPokemonStub::stubNOTValidResponsesForBasic();

        $this->pokeball->catchIt('mewtwo');
    }
}
