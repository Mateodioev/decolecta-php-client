<?php

namespace DecolectaApi\Client;

use DecolectaApi\Services\Reniec;
use DecolectaApi\Services\Sbs;
use DecolectaApi\Services\Sunat;

class Client
{
    public const string URL_BASE = 'https://api.decolecta.com';

    public function __construct(
        public Config $config,
    )
    {
    }

    public function reniec()
    {
        return new Reniec($this);
    }

    public function sbs()
    {
        return new Sbs($this);
    }

    public function sunat()
    {
        return new Sunat($this);
    }

    /**
     * @internal
     */
    public function call(string $method, string $path, array $params): array
    {
        $url   = $this->endpoint($path, $params);
        $token = $this->config->apiKey;

        $response = $this->config->httpClient->request($method, $url, [
            'http_errors'     => false,
            'connect_timeout' => $this->config->timeout,
            'headers'         => [
                'Authorization' => "Bearer $token",
                'User-Agent'    => 'mateodioev/decolecta-api-php',
                'Accept'        => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the url for the given endpoint.
     */
    private function endpoint(string $path, array $params = []): string
    {
        $url = self::URL_BASE . '/' . $path;

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }
}
