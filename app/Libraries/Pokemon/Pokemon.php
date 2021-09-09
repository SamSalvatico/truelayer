<?php

namespace App\Libraries\Pokemon;

interface Pokemon
{
    public static function box(string $name, string $description, bool $isLegendary, string $habitat): Pokemon;

    public function toArray(): array;

    public function name(): string;

    public function description(): string;

    public function isLegendary(): bool;

    public function habitat(): ?string;

    public function clone(?string $newDescription = null): Pokemon;
}
