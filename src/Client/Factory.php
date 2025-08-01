<?php

namespace DecolectaApi\Client;

class Factory
{
    /**
     * Create a new client using guzzle as the HTTP client.
     */
    public static function default(string $apiKey): Client
    {
        return self::withConfig(
            Config::new()->withApiKey($apiKey)
                ->withHttpClient(new \GuzzleHttp\Client())
        );
    }

    public static function withHttpClient(
        string $apiKey,
        \Psr\Http\Client\ClientInterface $httpClient
    ): Client
    {
        return self::withConfig(
            Config::new()->withApiKey($apiKey)
                ->withHttpClient($httpClient)
        );
    }

    public static function withConfig(Config $config): Client
    {
        return new Client($config);
    }
}
