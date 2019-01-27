# Rate Limiting

https://www.discogs.com/developers/#page:home,header:home-rate-limiting

## Implementation
`WebServCo\DiscogsApi\RateLimiter`

## How it works.

After a request is completed, the number of remaining requests (`X-Discogs-Ratelimit-Remaining`) is set globally.
```php
$this->throttleInterface->set($rateLimitRemaining);
```

Before executing new requests, the rate limiter checks the number of remaining requests.
If the number is `1`, execution is delayed for 60 seconds.

```php
$this->throttleInterface->throttle();
```

## Notes

> The value `1` is used because `0` means no value is set yet.

> This functionality can be turned off in the settings, since it may provide an unnecessary overhead for small applications (a file is being read / written on each request).
