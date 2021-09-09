<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

class FunnyTranslationParser
{
    protected array $funnyResponse;

    private function __construct(array $funnyResponse)
    {
        $this->funnyResponse = $funnyResponse;
    }

    public static function box(array $funnyResponse): self
    {
        return new FunnyTranslationParser($funnyResponse);
    }

    public function getTranslatedText(): ?string
    {
        if (
            !isset($this->funnyResponse['contents']) ||
            !isset($this->funnyResponse['contents']['translated'])
        ) {
            return null;
        }

        return $this->funnyResponse['contents']['translated'];
    }
}
