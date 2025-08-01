<?php

namespace DecolectaApi\Services;

use DateTime;

class Sunat extends AbstractService
{
    /**
     * Consultar información de RUC
     * @param int|string $numero Numero de RUC a consultar
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations#consuta-de-ruc-basico
     */
    public function ruc(int|string $numero): array
    {
        return $this->client->call('GET', '/v1/sunat/ruc', [
            'numero' => $numero,
        ]);
    }

    /**
     * Consultar información adicional de una empresa
     * @param int|string $numero Numero de RUC a consultar
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations#consulta-de-ruc-avanzado
     */
    public function rucAvanzado(int|string $numero): array
    {
        return $this->client->call('GET', '/v1/sunat/ruc/full', [
            'numero' => $numero,
        ]);
    }

    /**
     * Extraer tipo de cambio del dolar por fecha o mensual
     * @param ?DateTime $fecha Filtro por fecha
     * @param ?int $month Acepta del 1 al 12 correspondiente a un mes
     * @param ?int $year Fecha de 4 dígitos
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations#tipo-de-cambio
     */
    public function tipoCambio(?DateTime $fecha = null, ?int $month = null, ?int $year = null): array
    {
        $params = \array_filter([
            'date'  => $fecha?->format('Y-m-d'),
            'month' => $month,
            'year'  => $year,
        ]);

        return $this->client->call('GET', '/v1/tipo-cambio/sunat', $params);
    }
}
