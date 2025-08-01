# Decolecta API PHP Client

Cliente PHP para la API de [Decolecta](https://decolecta.com), que proporciona acceso a servicios de datos públicos peruanos (RENIEC, SBS, SUNAT).

## Instalación

Instala el paquete usando Composer:

```bash
composer require mateodioev/decolecta-api
```

## Requisitos

- PHP 8.0 o superior
- Extensión cURL habilitada
- Una API key válida de [Decolecta](https://decolecta.com)

## Uso Básico

```php
<?php

use DecolectaApi\Client\Factory;

require_once 'vendor/autoload.php';

// Crear cliente con tu API key
$client = Factory::default('tu-api-key-aqui');

// Consultar DNI en RENIEC
$persona = $client->reniec()->dni('12345678');
var_dump($persona);
```

## Servicios Disponibles

### RENIEC (Registro Nacional de Identificación y Estado Civil)

```php
// Consultar información personal por DNI
$resultado = $client->reniec()->dni('12345678');
```

### SUNAT (Superintendencia Nacional de Aduanas y de Administración Tributaria)

```php
// Consulta básica de RUC
$empresa = $client->sunat()->ruc('20123456789');

// Consulta avanzada de RUC
$empresaCompleta = $client->sunat()->rucAvanzado('20123456789');

// Tipo de cambio
$tipoCambio = $client->sunat()->tipoCambio();

// Tipo de cambio por fecha específica
$tipoCambio = $client->sunat()->tipoCambio(new DateTime('2024-01-15'));

// Tipo de cambio por mes y año
$tipoCambio = $client->sunat()->tipoCambio(null, 1, 2024); // Enero 2024
```

### SBS (Superintendencia de Banca, Seguros y AFP)

```php
// Tipo de cambio promedio (USD por defecto)
$cambio = $client->sbs()->cambioPromedio();

// Tipo de cambio promedio para otra moneda
$cambio = $client->sbs()->cambioPromedio('EUR');

// Tipo de cambio promedio por fecha
$cambio = $client->sbs()->cambioPromedio('USD', new DateTime('2024-01-15'));

// Tipo de cambio promedio por mes
$cambio = $client->sbs()->cambioPromedio('USD', null, 1, 2024);

// Tipo de cambio contable
$cambioContable = $client->sbs()->cambioContable();
```

## Configuración Avanzada

### Usando un cliente HTTP personalizado

```php
use DecolectaApi\Client\Factory;

$httpClient = new \GuzzleHttp\Client([
    'timeout' => 10,
    'verify' => false,
]);

$client = Factory::withHttpClient('tu-api-key', $httpClient);
```

### Configuración completa

```php
use DecolectaApi\Client\Config;
use DecolectaApi\Client\Factory;

$config = Config::new()
    ->withApiKey('tu-api-key')
    ->withTimeout(15)
    ->withHttpClient(new \GuzzleHttp\Client());

$client = Factory::withConfig($config);
```

## Documentación de la API

Para más detalles sobre los endpoints y respuestas, consulta la [documentación oficial de Decolecta](https://decolecta.gitbook.io/docs/).

## Licencia

Este proyecto está licenciado bajo la Licencia MIT.