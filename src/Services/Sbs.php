<?php

namespace DecolectaApi\Services;

use DateTime;

use function array_filter;

/**
 * Consultar información de superintendencia de banca y seguro
 */
class Sbs extends AbstractService
{
    /**
     * Extraer tipo de cambio PROMEDIO de las monedas publicadas filtrando por fecha o mensual,
     * @param string $currency Codigo de la moneda
     * @param ?DateTime $date Filtro por fecha
     * @param ?int $month Acepta del 1 al 12 correspondiente a un mes
     * @param ?int $year Fecha de 4 dígitos
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations-1#tipo-de-cambio-promedio
     */
    public function cambioPromedio(string $currency = 'USD', ?DateTime $date = null, ?int $month = null, ?int $year = null): array
    {
        $params = array_filter([
            'currency' => $currency,
            'date'     => $date?->format('Y-m-d'),
            'month'    => $month,
            'year'     => $year,
        ]);

        return $this->client->call('GET', '/v1/tipo-cambio/sbs/average', $params);
    }

    /**
     * Tipo de cambio promedio publicado por la SBS
     * @return array
     * @see https://decolecta.gitbook.io/docs/servicios/integrations-1#tipo-de-cambio-contable
     */
    public function cambioContable(): array
    {
        return $this->client->call('GET', '/v1/tipo-cambio/sbs/contable', []);
    }
}
