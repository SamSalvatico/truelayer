<?php

namespace Tests\Unit\PokemonTranslator;

use App\Libraries\Pokemon\BasicPokemon;
use App\Libraries\PokemonTranslator\FunnyTranslator\ShakespeareTranslatorCreator;
use App\Libraries\PokemonTranslator\FunnyTranslator\YodaTranslatorCreator;
use App\Libraries\PokemonTranslator\PokemonTranslationChooser;
use Tests\TestCase;

class PokemonTranslationChooserTest extends TestCase
{
    public function testYodaTranslationIfLegendaryAndLivesInACave(): void
    {
        $trans = PokemonTranslationChooser::getTranslator(BasicPokemon::box('pippo', 'desc', true, 'cave'));

        $this->assertInstanceOf(YodaTranslatorCreator::class, $trans);
    }

    public function testYodaTranslationIfLegendaryAndNotLivesInACave(): void
    {
        $trans = PokemonTranslationChooser::getTranslator(BasicPokemon::box('pippo', 'desc', true, 'forest'));

        $this->assertInstanceOf(YodaTranslatorCreator::class, $trans);
    }

    public function testYodaTranslationIfNotLegendaryButLivesInACave(): void
    {
        $trans = PokemonTranslationChooser::getTranslator(BasicPokemon::box('pippo', 'desc', false, 'cave'));

        $this->assertInstanceOf(YodaTranslatorCreator::class, $trans);
    }

    public function testShakespeareTranslationIfNotLegendaryAndNotLivesInACave(): void
    {
        $trans = PokemonTranslationChooser::getTranslator(BasicPokemon::box('pippo', 'desc', false, 'forest'));

        $this->assertInstanceOf(ShakespeareTranslatorCreator::class, $trans);
    }
}
