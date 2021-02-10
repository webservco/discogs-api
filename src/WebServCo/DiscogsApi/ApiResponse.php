<?php declare(strict_types = 1);

namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiResponseException;
use WebServCo\Framework\Http\Response;

final class ApiResponse extends \WebServCo\Api\AbstractResponse
{

    protected string $endpoint;

    /**
     * @var mixed
     */
    protected $data;

    protected string $method;

    protected Response $response; // \WebServCo\Framework\Http\Response

    protected int $status;

    public function getErrorMessage(): string
    {
        if (\in_array($this->status, [200, 201, 204])) {
            return ''; // no error
        }

        if (isset($this->data['error'])) {
            return $this->data['error'];
        }
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
        if (!empty($this->data)) {
            return \strval($this->data);
        }
        return ApiResponseException::DEFAULT_MESSAGE;
    }

    public function getRateLimitRemaining(): int
    {
        return (int) $this->response->getHeaderLine('x-discogs-ratelimit-remaining');
    }
}
