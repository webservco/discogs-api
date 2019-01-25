<?php
namespace WebServCo\DiscogsApi\Exceptions;

class ApiException extends \WebServCo\Framework\Exceptions\ApplicationException
{
    const CODE = 0;

    const DEFAULT_MESSAGE = 'Discogs Api Error';

    public function __construct($message, $code = self::CODE, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
