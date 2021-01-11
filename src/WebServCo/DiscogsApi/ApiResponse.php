<?php
namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiResponseException;

final class ApiResponse extends \WebServCo\Api\AbstractResponse
{
    protected $endpoint;
    protected $data;
    protected $method;
    protected $response; // \WebServCo\Framework\Http\Response
    protected $status;

    public function getErrorMessage()
    {
        if (in_array($this->status, [200, 201, 204])) {
            return false; // no error
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

    public function getRateLimitRemaining()
    {
        return (int) $this->response->getHeader('x-discogs-ratelimit-remaining');
    }
}
