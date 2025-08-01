# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Architecture Overview

This is a PHP library for interfacing with the Decolecta API (api.decolecta.com), which provides access to Peruvian public data services (RENIEC, SBS, SUNAT).

**Client Architecture Pattern:**
- `Client\Factory` - Creates configured client instances with different HTTP clients
- `Client\Client` - Main API client that handles authentication and HTTP requests to api.decolecta.com:443 
- `Client\Config` - Configuration object using fluent interface pattern
- `Services\AbstractService` - Base class for all service implementations
- Individual service classes (`Reniec`, `Sbs`, `Sunat`) extend AbstractService

**Key Design Patterns:**
- Factory pattern for client creation
- Service objects for each API endpoint group
- PSR-7/PSR-18 HTTP client abstraction (defaults to Guzzle)
- Bearer token authentication in Authorization header

## Development Commands

**Install dependencies:**
```bash
composer install
```

**Update dependencies:**
```bash
composer update
```

**Run basic test/example:**
```bash
php test.php
```

**Validate composer.json:**
```bash
composer validate
```

**Dump autoloader:**
```bash
composer dump-autoload
```

## Usage Pattern

The library follows a consistent pattern:
1. Create client via Factory with API key
2. Access service methods through client (e.g., `$client->reniec()->dni()`)
3. All service methods return associative arrays from JSON responses

Example from test.php:
```php
$client = Factory::default('<you api here>');
$result = $client->reniec()->dni(12345678);
```

## Authentication

All API calls require a Bearer token passed via the `apiKey` in Config. The client automatically adds this to the Authorization header for all requests.