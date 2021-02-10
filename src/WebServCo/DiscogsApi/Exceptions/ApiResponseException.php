<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi\Exceptions;

class ApiResponseException extends \WebServCo\Framework\Exceptions\ApplicationException
{

    const CODE = 0;

    const DEFAULT_MESSAGE = 'Discogs Api Error';

    public function __construct($message, ?\Throwable $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
