<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi;

use WebServCo\Api\AbstractResponse;
use WebServCo\DiscogsApi\Exceptions\ApiResponseException;
use WebServCo\Framework\Http\Response;

use function in_array;
use function strval;

final class ApiResponse extends AbstractResponse
{
    protected string $endpoint;

    protected mixed $data;

    protected string $method;

    // \WebServCo\Framework\Http\Response
    protected Response $response;

    protected int $status;

    public function getErrorMessage(): string
    {
        if (in_array($this->status, [200, 201, 204], true)) {
            // no error
            return '';
        }

        if (isset($this->data['error'])) {
            return $this->data['error'];
        }
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
        if (!empty($this->data)) {
            return strval($this->data);
        }

        return ApiResponseException::DEFAULT_MESSAGE;
    }

    public function getRateLimitRemaining(): int
    {
        return (int) $this->response->getHeaderLine('x-discogs-ratelimit-remaining');
    }
}
