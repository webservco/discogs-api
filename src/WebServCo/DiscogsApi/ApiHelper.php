<?php

declare(strict_types=1);

namespace WebServCo\DiscogsApi;

use WebServCo\DiscogsAuth\Interfaces\AuthInterface;

final class ApiHelper
{

    /**
    * @param array<string,mixed> $apiConfig
    */
    public static function init(array $apiConfig, string $logPath, string $tmpPath): Api
    {
        $authLibrary = self::initAuthLibrary($apiConfig);

        $logger = new \WebServCo\Framework\Log\FileLogger('DiscogsApi', $logPath);

        $browserLogger = new \WebServCo\Framework\Log\FileLogger('DiscogsApiBrowser', $logPath);

        $browser = new \WebServCo\Framework\Http\CurlClient($browserLogger);

        $throttle = new RateLimiter($tmpPath);

        $settings = self::initSettings($apiConfig);

        return new Api($authLibrary, $browser, $logger, $throttle, $settings);
    }

    /**
    * @param array<string,mixed> $apiConfig
    */
    protected static function initAuthLibrary(array $apiConfig): AuthInterface
    {
        if (empty($apiConfig['auth']['type'])) {
            throw new \InvalidArgumentException('Missing or invalid parameter: auth type');
        }
        switch ($apiConfig['auth']['type']) {
            case 'user':
                return self::initUserAuthLibrary($apiConfig['auth']);
            case 'app':
                return self::initAppAuthLibrary($apiConfig['auth']);
            case 'oauth':
                return self::initOauthAuthLibrary($apiConfig['auth']);
            default:
                throw new \InvalidArgumentException('Invalid parameter: auth type');
        }
    }

    /**
    * @param array<string,mixed> $authConfig
    */
    protected static function initAppAuthLibrary(array $authConfig): AuthInterface
    {
        foreach (['consumerKey', 'consumerSecret'] as $item) {
            if (empty($authConfig['app'][$item])) {
                throw new \InvalidArgumentException(\sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new \WebServCo\DiscogsAuth\Discogs\App(
            $authConfig['app']['consumerKey'],
            $authConfig['app']['consumerSecret'],
        );
    }

    /**
    * @param array<string,mixed> $authConfig
    */
    protected static function initOauthAuthLibrary(array $authConfig): AuthInterface
    {
        foreach (['consumerKey', 'consumerSecret'] as $item) {
            if (empty($authConfig['app'][$item])) {
                throw new \InvalidArgumentException(\sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        foreach (['oauthToken', 'oauthTokenSecret'] as $item) {
            // permanent tokens may not be set yet; check only field existance
            if (!isset($authConfig['oauth']['access'][$item])) {
                throw new \InvalidArgumentException(\sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new \WebServCo\DiscogsAuth\OAuth\OAuth(
            $authConfig['app']['consumerKey'],
            $authConfig['app']['consumerSecret'],
            $authConfig['oauth']['access']['oauthToken'],
            $authConfig['oauth']['access']['oauthTokenSecret'],
        );
    }

    /**
    * @param array<string,mixed> $authConfig
    */
    protected static function initUserAuthLibrary(array $authConfig): AuthInterface
    {
        if (empty($authConfig['user']['personalAccessToken'])) {
            throw new \InvalidArgumentException('Missing or invalid parameter: personalAccessToken');
        }
        return new \WebServCo\DiscogsAuth\Discogs\User($authConfig['user']['personalAccessToken']);
    }

    /**
    * @param array<string,mixed> $apiConfig
    */
    protected static function initSettings(array $apiConfig): Settings
    {
        foreach (['debug', 'rateLimiting', 'userAgent'] as $item) {
            if (!isset($apiConfig['settings'][$item])) {
                throw new \InvalidArgumentException(\sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new Settings(
            $apiConfig['settings']['debug'],
            $apiConfig['settings']['rateLimiting'],
            $apiConfig['settings']['userAgent'],
        );
    }
}
