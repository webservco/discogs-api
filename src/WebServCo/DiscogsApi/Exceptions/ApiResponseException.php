<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Exceptions;

use Throwable;
use WebServCo\Framework\Exceptions\ApplicationException;

final class ApiResponseException extends ApplicationException
{
    public const int CODE = 0;

    public const string DEFAULT_MESSAGE = 'Discogs Api Error';

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
