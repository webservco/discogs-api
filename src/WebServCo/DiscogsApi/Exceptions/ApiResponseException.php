<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Exceptions;

class ApiResponseException extends \WebServCo\Framework\Exceptions\ApplicationException
{
    public const CODE = 0;

    public const DEFAULT_MESSAGE = 'Discogs Api Error';

    public function __construct(string $message, ?\Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
