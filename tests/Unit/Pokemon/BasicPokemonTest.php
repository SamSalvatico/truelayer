<?php

namespace Tests\Unit\Pokemon;

use App\Libraries\Pokemon\BasicPokemon;
use Tests\TestCase;

class BasicPokemonTest extends TestCase
{
    public function testToArrayWorksFine(): void
    {
        $infos = $this->getInstance()->toArray();

        $this->assertArrayHasKey('name', $infos);
        $this->assertArrayHasKey('description', $infos);
        $this->assertArrayHasKey('isLegendary', $infos);
        $this->assertArrayHasKey('habitat', $infos);
        $this->assertEquals('pippo', $infos['name']);
        $this->assertEquals(false, $infos['isLegendary']);
        $this->assertEquals('cave', $infos['habitat']);
    }

    private function getInstance()
    {
        return BasicPokemon::box('pippo', 'desc', false, 'cave');
    }

    public function testNameReturnsValidValue(): void
    {
        $this->assertSame('pippo', $this->getInstance()->name());
    }

    public function testDescriptionReturnsValidValue(): void
    {
        $this->assertSame('desc', $this->getInstance()->description());
    }

    public function testIsLegendaryReturnsValidValue(): void
    {
        $this->assertSame(false, $this->getInstance()->isLegendary());
    }

    public function testHabitatReturnsValidValue(): void
    {
        $this->assertSame('cave', $this->getInstance()->habitat());
    }
}
