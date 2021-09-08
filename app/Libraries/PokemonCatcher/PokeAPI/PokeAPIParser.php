<?php

namespace App\Libraries\PokemonCatcher\PokeAPI;

use App\Libraries\PokemonCatcher\PokemonCatcher;
use App\Libraries\Pokemon\Pokemon;

class PokeAPIParser
{
    private const VALID_LANGUAGE = 'en';

    private array $serverResponse;

    public function __construct(array $serverResponse)
    {
        $this->serverResponse = $serverResponse;
    }

    public static function box(array $serverResponse): self
    {
        return new self($serverResponse);
    }

    public function parse(): Pokemon
    {
        return Pokemon::box(
            $this->getName(),
            $this->getDescription(),
            $this->getIsLegendary(),
            $this->getHabitat()
        );
    }

    private function getName(): ?string
    {
        if (isset($this->serverResponse['name'])) {
            return $this->serverResponse['name'];
        }
        return null;
    }

    private function getHabitat(): ?string
    {
        if (isset($this->serverResponse['habitat'])) {
            return $this->serverResponse['habitat'];
        }
        return null;
    }

    private function getIsLegendary(): bool
    {
        if (isset($this->serverResponse['is_legendary'])) {
            return $this->serverResponse['is_legendary'];
        }
        return false;
    }

    private function getDescription(): ?string
    {
        if (
            !isset($this->serverResponse['flavor_text_entries'])
            || count($this->serverResponse['flavor_text_entries']) < 1
        ) {
            return null;
        }
        $flavorTextEntries = $this->serverResponse['flavor_text_entries'];

        return $this->getValidFlavorDescriptions($flavorTextEntries);
    }

    private function getValidFlavorDescriptions(array $flavorEntries): ?string
    {
        foreach ($flavorEntries as $currentFlavor) {
            if (
                isset($currentFlavor['flavor_text']) &&
                isset($currentFlavor['language']) &&
                $currentFlavor['language']['name'] == self::VALID_LANGUAGE
            ) {
                return $currentFlavor['flavor_text'];
            }
        }
        return null;
    }
}
