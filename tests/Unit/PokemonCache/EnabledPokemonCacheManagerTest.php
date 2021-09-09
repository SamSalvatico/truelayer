<?php

namespace Tests\Unit\PokemonCache;

use App\Libraries\Pokemon\BasicPokemon;
use App\Libraries\PokemonCache\EnabledPokemonCacheManager;
use Tests\TestCase;

class EnabledPokemonCacheManagerTest extends TestCase
{
    /**
     * @dataProvider methods
     */
    public function testValueIsCached(string $methodName): void
    {
        $cacheManager = new EnabledPokemonCacheManager();
        $firstPokemon = $cacheManager->$methodName('poke', function () {
            return BasicPokemon::box('poke', 'mon', false, null);
        });
        $secondPokemon = $cacheManager->$methodName('poke', function () {
            return BasicPokemon::box('second', 'mon', false, null);
        });

        $this->assertSame($firstPokemon->name(), $secondPokemon->name());
        $this->assertSame('poke', $secondPokemon->name());
    }

    public function methods(): array
    {
        return [
            ['translated'],
            ['basic'],
        ];
    }
}
