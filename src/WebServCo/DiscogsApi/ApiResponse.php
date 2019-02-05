<?php
namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsApi\Exceptions\ApiResponseException;

final class ApiResponse
{
    protected $endpoint;
    protected $data;
    protected $method;
    protected $response; // \WebServCo\Framework\Http\Response
    protected $status;

    public function __construct($endpoint, $method, \WebServCo\Framework\Http\Response $response)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->response = $response;
        $this->status = $this->response->getStatus();
        $this->data = $this->processResponseData();
    }

    public function getData()
    {
        return $this->data;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

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

    public function getMethod()
    {
        return $this->method;
    }

    public function getRateLimitRemaining()
    {
        return (int) $this->response->GetHeader('X-Discogs-Ratelimit-Remaining');
    }

    public function getStatus()
    {
        return $this->status;
    }

    protected function processResponseData()
    {
        $responseContent = $this->response->getContent();
        $contentType = $this->response->getHeader('Content-Type');
        switch ($contentType) {
            case 'application/json': // api
                return json_decode($responseContent, true);
                break;
            case 'application/x-www-form-urlencoded': // oauth
                if (false === strpos($responseContent, '=')) {
                    /* Sometimes Discogs returns text/plain with this content type ... */
                    return $responseContent;
                }
                $data = [];
                parse_str($responseContent, $data);
                return $data;
                break;
            case 'text/plain': // oauth
                return $responseContent;
                break;
            default:
                throw new ApiResponseException('Api returned unsupported content type.');
                break;
        }
    }
}
