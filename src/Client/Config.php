<?php

namespace DecolectaApi\Client;

use GuzzleHttp\ClientInterface;

final class Config
{
    public string          $apiKey;
    public ClientInterface $httpClient;
    public int             $timeout    = 5;

    private static ?Config $instance = null;

    public static function instance(): Config
    {
        if (self::$instance === null) {
            self::$instance = self::new();
        }
        return self::$instance;
    }

    public static function new(): Config
    {
        return new Config();
    }

    public function withApiKey(string $key): Config
    {
        $this->apiKey = $key;
        return $this;
    }

    public function withTimeout(int $timeout): Config
    {
        $this->timeout = $timeout;
        return $this;
    }

    public function withHttpClient(ClientInterface $client): Config
    {
        $this->httpClient = $client;
        return $this;
    }
}
