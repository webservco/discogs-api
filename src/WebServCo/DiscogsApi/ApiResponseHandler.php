<?php
namespace WebServCo\DiscogsApi;

final class ApiResponseHandler
{
    protected $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function handle()
    {
        $responseStatus = $this->apiResponse->getStatus();
        switch ($responseStatus) {
            case 200:
                /*
                * OK
                * The request was successful, and the requested data is provided in the response body.
                */
            case 201:
                /*
                * Continue
                * You’ve sent a POST request to a list of resources to create a new one.
                * The ID of the newly-created resource will be provided in the body of the response.
                */
            case 204:
                /*
                * No Content
                * The request was successful, and the server has no additional information to convey,
                * so the response body is empty.
                */
                return $this->apiResponse;
                break;
            case 401:
                /*
                * Unauthorized
                * You’re attempting to access a resource that first requires authentication.
                * See Authenticating with OAuth.
                */
            case 403:
                /*
                * Forbidden
                * You’re not allowed to access this resource. Even if you authenticated, or already have,
                * you simply don’t have permission. Trying to modify another user’s profile, for example,
                * will produce this error.
                */
            case 404:
                /*
                * Not Found
                * The resource you requested doesn’t exist.
                */
            case 405:
                /*
                * Method Not Allowed
                * You’re trying to use an HTTP verb that isn’t supported by the resource.
                * Trying to PUT to /artists/1, for example, will fail because Artists are read-only.
                */
            case 422:
                /*
                * Unprocessable Entity
                * Your request was well-formed, but there’s something semantically wrong with the body of the request.
                * This can be due to malformed JSON, a parameter that’s missing or the wrong type,
                * or trying to perform an action that doesn’t make any sense. Check the response body for
                * specific information about what went wrong.
                */
            case 500:
                /*
                * Internal Server Error
                * Something went wrong on our end while attempting to process your request.
                * The response body’s message field will contain an error code that you can send to Discogs Support
                * (which will help us track down your specific issue).
                */
            default:
                $message = $this->apiResponse->getErrorMessage();
                throw new \WebServCo\DiscogsApi\Exceptions\ApiResponseException(
                    $message
                );
                break;
        }
    }
}
