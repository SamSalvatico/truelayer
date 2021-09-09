<?php

namespace App\Libraries\PokemonTranslator\FunnyTranslator;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class FunnyRateException extends Exception implements HttpExceptionInterface
{
    public function __construct(string $message)
    {
        parent::__construct(
            // phpcs:ignore
            "Exception invoking FunAPI (If you still want some fantastic stuffs, try invoking not-translated APIs). Message: "
                . $message
        );
    }

    public function getStatusCode(): int
    {
        return 429;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
