<?php

namespace DecolectaApi\Services;

use InvalidArgumentException;

class Afp extends AbstractService
{
    public function comisiones(int $year, int $month)
    {
        if ($month < 1 || $month > 12) {
            throw new InvalidArgumentException("Mes fuera de rango");
        }

        return $this->client->call("GET", "/v1/afp/comisiones", [
            "year" => $year,
            "month" => $month,
        ]);
    }
}
