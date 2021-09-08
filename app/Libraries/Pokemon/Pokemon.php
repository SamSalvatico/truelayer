<?php

namespace App\Libraries\Pokemon;

interface Pokemon
{
    public static function box(string $name, string $description, bool $isLegendary, string $habitat): Pokemon;

    public function toArray(): array;
}
