# webservco/discogs-api

A PHP library for [webservco/framework](https://github.com/webservco/framework).

Client for the [Discogs API](https://www.discogs.com/developers/), with authentication, rate limiting and error handling built in.

> **Note:** `webservco/framework` is considered legacy. It has been replaced by individual components, please see [webservco/sandbox](https://webservco.github.io/sandbox/).

- Requires: PHP 8.3+, `ext-curl`, a writable directory for the rate limiter
- Related: `webservco/discogs-auth` (authorization headers), `webservco/api` (`ApiResponse` extends its `AbstractResponse`), `webservco/discogs-examples` (a web app calling every endpoint)

---

## Installation

```shell
composer require webservco/discogs-api
```

---

## Usage

```php
use WebServCo\DiscogsApi\Api\User\Collection\Value;
use WebServCo\DiscogsApi\Client;
use WebServCo\DiscogsApi\RateLimiter;
use WebServCo\DiscogsApi\Settings;
use WebServCo\DiscogsAuth\Discogs\User;
use WebServCo\Framework\Http\CurlClient;
use WebServCo\Framework\Log\FileLogger;

$settings = new Settings(
    // debug: log every HTTP request and response.
    false,
    // rateLimiting
    true,
    // userAgent: Discogs requires one that identifies your app.
    'ExampleApp/1.0 +https://example.com',
);

// \WebServCo\DiscogsApi\Interfaces\ApiInterface
$api = new Client(
    // Any \WebServCo\DiscogsAuth\Interfaces\AuthInterface.
    new User($personalAccessToken),
    new CurlClient(new FileLogger('DiscogsApiHttp', $logPath)),
    new FileLogger('DiscogsApi', $logPath),
    // Trailing slash required.
    new RateLimiter(sprintf('%svar/tmp/', $projectPath)),
    $settings,
);

// \WebServCo\DiscogsApi\ApiResponse
$apiResponse = (new Value($api, 'example_user'))->get();
$data = $apiResponse->getData();
```

For an endpoint without its own class, call the client directly. The endpoint is relative to `https://api.discogs.com/`.

```php
$apiResponse = $api->get('releases/249504');
// $data can be an array (encoded to JSON) or a JSON string.
$apiResponse = $api->post('users/example_user/collection/folders', ['name' => 'Example']);
```

---

## Endpoints

| Endpoint | Method | Class |
| --- | --- | --- |
| `oauth/request_token` | `GET` | `Api\OAuth\RequestToken` |
| `oauth/access_token` | `POST` | `Api\OAuth\AccessToken` |
| `oauth/identity` | `GET` | `Api\OAuth\Identity` |
| `users/{username}` | `GET` | `Api\User\Identity\Profile` |
| `users/{username}/collection/fields` | `GET` | `Api\User\Collection\Fields` |
| `users/{username}/collection/value` | `GET` | `Api\User\Collection\Value` |

The OAuth classes need a client built with the matching `webservco/discogs-auth` class. Its README walks through the flow.

The library also has static `Parsers\Collection\*` classes that turn collection item arrays (artists, labels, formats, catalog numbers) into display strings, and `Validators\*` classes that check the structure of collection, wantlist, inventory and list items.

Namespaces are relative to `WebServCo\DiscogsApi\`.

---

## Notes

Status codes other than 200, 201 and 204 throw `Exceptions\ApiResponseException` with the message Discogs sent back.

With `rateLimiting` on, the client saves `X-Discogs-Ratelimit-Remaining` to a `DiscogsApiRateLimiter` file after each response. When only 1 request is left, the next call sleeps for 60 seconds. That's a file read and write on every request, so small apps may want to turn it off.

The client always sends `Accept: application/vnd.discogs.v2.discogs+json`. Only `GET` and `POST` are supported.

---

## Documentation

- [Usage](docs/Usage.md): Calling the client directly.
- [Authorization](docs/Authorization.md): The Discogs authentication types.
- [OAuthFlow](docs/OAuthFlow.md): The requests and responses of each OAuth step.
- [Endpoints](docs/Endpoints.md): Discogs endpoints, with the implementing classes.
- [Settings](docs/Settings.md): Client settings.
- [RateLimiting](docs/RateLimiting.md): How rate limiting works.
- [Troubleshooting](docs/Troubleshooting.md): Common errors.

---

## Development

```shell
# Start project.
ddev start
# Install dependencies.
ddev c u
# Run all validations.
ddev c c
# Run unit tests.
ddev c test:d
```

---

## License

[MIT](LICENSE)
