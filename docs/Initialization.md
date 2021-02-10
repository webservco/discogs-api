# Initialization

## Configuration array
```php
    [
        'auth' => [
            'type' => '', // user, app, oauth
            'app' => [
                'consumerKey' => '',
                'consumerSecret' => '',
            ],
            'oauth' => [
                'flow' => [
                    'callback' => '',
                    'oauthToken' => '',
                    'oauthTokenSecret' => '',
                    'oauthVerifier' => '',
                ],
                'access' => [
                    'oauthToken' => '',
                    'oauthTokenSecret' => '',
                ],
            ],
            'user' => [
                'personalAccessToken' => '',
            ],
        ],
        'settings' => [
            'debug' => true,
            'rateLimiting' => true,
            'userAgent' => '',
        ],
        'username' =>'',
    ],
```

## Library
```php
$this->api = \WebServCo\DiscogsApi\ApiHelper::init(
    <configurationArray>,
    <logPath>
);
```
