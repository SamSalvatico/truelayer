<?php

namespace App\Libraries\Pokeball;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class NoPokemonFoundException extends Exception implements HttpExceptionInterface
{
    public function __construct(string $pokemonName)
    {
        parent::__construct("Cannot find the Pokemon named '$pokemonName'");
    }

    public function getStatusCode(): int
    {
        return 404;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
