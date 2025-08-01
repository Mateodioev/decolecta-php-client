<?php

namespace DecolectaApi\Services;

use DecolectaApi\Client\Client;

class Reniec extends AbstractService
{
    /**
     * Extraer información de personas 
     * @param int|string $numero
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations-2#dni-consulta-de-datos-personales
     */
    public function dni(int|string $numero): array
    {
        return $this->client->call('GET', '/v1/reniec/dni', [
            'numero' => $numero,
        ]);
    }
}
