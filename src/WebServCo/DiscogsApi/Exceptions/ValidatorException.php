<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi\Exceptions;

use Throwable;
use WebServCo\Framework\Exceptions\ApplicationException;

final class ValidatorException extends ApplicationException
{
    public const int CODE = 0;

    public function __construct(string $message, ?Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
