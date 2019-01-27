<?php
namespace WebServCo\DiscogsApi\Exceptions;

class ApiResponseException extends \WebServCo\Framework\Exceptions\ApplicationException
{
    const CODE = 0;

    const DEFAULT_MESSAGE = 'Discogs Api Error';

    public function __construct($message, \Exception $previous = null)
    {
        parent::__construct($message, self::CODE, $previous);
    }
}
