<?php

namespace Tests\Unit\PokemonCache;

use App\Libraries\Pokemon\BasicPokemon;
use App\Libraries\PokemonCache\DisabledPokemonCacheManager;
use Tests\TestCase;

class DisabledPokemonCacheManagerTest extends TestCase
{
    /**
     * @dataProvider methods
     */
    public function testValueIsNotCached(string $methodName): void
    {
        $cacheManager = new DisabledPokemonCacheManager();
        $firstPokemon = $cacheManager->$methodName('poke', function () {
            return BasicPokemon::box('poke', 'mon', false, null);
        });
        $secondPokemon = $cacheManager->$methodName('poke', function () {
            return BasicPokemon::box('second', 'mon', false, null);
        });

        $this->assertNotEquals($firstPokemon->name(), $secondPokemon->name());
        $this->assertSame('second', $secondPokemon->name());
    }

    public function methods(): array
    {
        return [
            ['translated'],
            ['basic'],
        ];
    }
}
