<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Exceptions;

class ValidatorException extends \WebServCo\Framework\Exceptions\ApplicationException
{

    public const CODE = 0;

    public function __construct(string $message, ?\Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
