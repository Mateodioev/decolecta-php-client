<?php

namespace DecolectaApi\Services;

use DecolectaApi\Client\Client;

abstract class AbstractService
{
    public function __construct(private Client $client)
    {
        # code...
    }
}
