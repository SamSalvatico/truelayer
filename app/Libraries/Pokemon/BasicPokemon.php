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
            'name' => $this->name(),
            'description' => $this->description(),
            'isLegendary' => $this->isLegendary(),
            'habitat' => $this->habitat(),
        ];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function isLegendary(): string
    {
        return $this->isLegendary;
    }

    public function habitat(): ?string
    {
        return $this->habitat;
    }

    public function clone(?string $newDescription = null): Pokemon
    {
        $description = (is_null($newDescription) ? $this->description() : $newDescription);
        return self::box(
            $this->name(),
            $description,
            $this->isLegendary(),
            $this->habitat()
        );
    }
}
