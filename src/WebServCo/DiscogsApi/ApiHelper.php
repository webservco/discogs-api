<?php
namespace WebServCo\DiscogsApi;

final class ApiHelper
{
    public static function init($apiConfig, $logPath)
    {
        $authLibrary = self::initAuthLibrary($apiConfig);

        $requestLibrary = \WebServCo\Framework\Framework::library('Request');

        $logger = new \WebServCo\Framework\Log\FileLogger(
            'DiscogsApi',
            $logPath,
            $requestLibrary
        );

        $browserLogger = new \WebServCo\Framework\Log\FileLogger(
            'DiscogsApiBrowser',
            $logPath,
            $requestLibrary
        );

        $browser = new \WebServCo\Framework\CurlBrowser($browserLogger);
        $browser->setDebug(true);

        $settings = self::initSettings($apiConfig);

        return new Api($authLibrary, $browser, $logger, $settings);
    }

    protected static function initAuthLibrary($apiConfig)
    {
        if (empty($apiConfig['auth']['type'])) {
            throw new \InvalidArgumentException('Missing or invalid parameter: auth type');
        }
        switch ($apiConfig['auth']['type']) {
            case 'user':
                return self::initUserAuthLibrary($apiConfig['auth']);
                break;
            case 'app':
                return self::initAppAuthLibrary($apiConfig['auth']);
                break;
            case 'oauth':
                return self::initOauthAuthLibrary($apiConfig['auth']);
                break;
            default:
                throw new \InvalidArgumentException('Invalid parameter: auth type');
                break;
        }
    }

    protected static function initAppAuthLibrary($authConfig)
    {
        foreach (['consumerKey', 'consumerSecret'] as $item) {
            if (empty($authConfig['app'][$item])) {
                throw new \InvalidArgumentException(sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new \WebServCo\DiscogsAuth\Discogs\App(
            $authConfig['app']['consumerKey'],
            $authConfig['app']['consumerSecret']
        );
    }

    protected static function initOauthAuthLibrary($authConfig)
    {
        foreach (['consumerKey', 'consumerSecret'] as $item) {
            if (empty($authConfig['app'][$item])) {
                throw new \InvalidArgumentException(sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new \WebServCo\DiscogsAuth\OAuth\OAuth(
            $authConfig['app']['consumerKey'],
            $authConfig['app']['consumerSecret']
        );
    }

    protected static function initUserAuthLibrary($authConfig)
    {
        if (empty($authConfig['user']['personalAccessToken'])) {
            throw new \InvalidArgumentException('Missing or invalid parameter: personalAccessToken');
        }
        return new \WebServCo\DiscogsAuth\Discogs\User(
            $authConfig['user']['personalAccessToken']
        );
    }

    protected static function initSettings($apiConfig)
    {
        foreach (['debug', 'processResponse', 'userAgent'] as $item) {
            if (!isset($apiConfig['settings'][$item])) {
                throw new \InvalidArgumentException(sprintf('Missing or invalid parameter: %s', $item));
            }
        }
        return new Settings(
            $apiConfig['settings']['debug'],
            $apiConfig['settings']['processResponse'],
            $apiConfig['settings']['userAgent']
        );
    }
}
