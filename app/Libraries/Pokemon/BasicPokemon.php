<?php

namespace App\Libraries\Pokemon;

class BasicPokemon implements Pokemon
{
    protected string $name;
    protected string $description;
    protected bool $isLegendary;
    protected ?string $habitat;

    final public function __construct(string $name, string $description, bool $isLegendary, ?string $habitat)
    {
        $this->name = $name;
        $this->description = $description;
        $this->isLegendary = $isLegendary;
        $this->habitat = $habitat;
    }

    final public static function box(string $name, string $description, bool $isLegendary, ?string $habitat): Pokemon
    {
        return new self(
            $name,
            $description,
            $isLegendary,
            $habitat
        );
    }

    final public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'is_legendary' => $this->isLegendary,
            'habitat' => $this->habitat
        ];
    }
}
