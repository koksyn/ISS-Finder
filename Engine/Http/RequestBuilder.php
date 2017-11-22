<?php

namespace Engine\Http;

class RequestBuilder
{
    /**
     * @return Request
     */
    public static function build(): Request
    {
        /** @var Request $request */
        $request = new Request();

        /** @var string $pattern */
        $pattern = self::getPattern();
        $request->setPattern($pattern);

        /** @var string $baseUrl */
        $baseUrl = self::getBaseUrl();
        $request->setBaseUrl($baseUrl);

        /** @var array $headers */
        $headers = self::fetchByNeedle('HTTP_');
        $request->setHeaders($headers);

        return $request;
    }

    /**
     * @return string
     */
    private static function getPattern()
    {
        /** @var string $redirectBase */
        $redirectBase = $_SERVER['REDIRECT_BASE'];
        /** @var string $redirectUrl */
        $redirectUrl = $_SERVER['REDIRECT_URL'];

        return substr($redirectUrl, strlen($redirectBase), strlen($redirectUrl));
    }

    /**
     * @return string
     */
    private static function getBaseUrl()
    {
        return sprintf(
            '%s://%s%s/',
            $_SERVER['REQUEST_SCHEME'],
            $_SERVER['SERVER_NAME'],
            $_SERVER['REDIRECT_BASE']
        );
    }

    /**
     * @param string $prefix
     * @return array
     */
    private static function fetchByNeedle(string $prefix)
    {
        /** @var array $results */
        $results = [];

        foreach($_SERVER as $key => $value) {
            if (strpos($prefix, $key) !== false) {
                $results[$key] = $value;
            }
        }

        return $results;
    }
}