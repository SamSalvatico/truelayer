# TrueLayer

## Index

- [Project](#project)
- [Prerequisites](#prerequisites)
- [Start with makefile](#start-with-makefile)
- [Endpoints](#caching)
- [Caching](#caching)
- [Tests](#tests)
    - [With Makefile](#with-makefile)

## Project

The project is based on [Laravel 8](https://laravel.com/docs/8.x) and uses PHP8.

## Prerequisites

- [Docker](https://docker.com) installed to run it using Sail;
- Composer
    - Installed to be able to install Sail, see [Composer](https://getcomposer.org/)
    - via Docker to install Sail, see [Composer via Docker](https://hub.docker.com/_/composer)

## Start with Makefile

`cd` into the **truelayer** root folder.

Run
```bash
$ make install
```

Now you're ready to party!

The application is ready on port 80 of localhost.

## Endpoints

Get a basic pokemon:
```
GET /pokemon/{name}
```

Get a translated one:
```
GET /pokemon/translated/{name}
```

## Caching
By default the cache is enabled. If you want to disable it you must open the `.env` file, search for `IS_POKEMON_CACHE_ENABLED` and set it to `false`.

Then, to clear the already-existent cache, run
```
make cache-clear
```

## Tests
The tests run using PHPUnit, PHPcs and PHPstan.

### With Makefile

The next command will run PHPstan, PHPcs and PHPUnit
```bash
$ make test
```

