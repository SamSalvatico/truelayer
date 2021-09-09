# TrueLayer

## Index

- [Project](#project)
- [Prerequisites](#prerequisites)
- [Environment configuration](#environment-configuration-without-makefile)
- [Start with makefile](#start-with-makefile)
- [Fixture](#fixture)
- [Login](#login)
- [Tests](#tests)
    - [With Makefile](#with-makefile)

## Project

The project is based on [Laravel 8](https://laravel.com/docs/8.x) and uses PHP8.

## Prerequisites

- [Docker](https://docker.com) installed to run it using Sail;
- Composer
    - Installed to be able to install Sail, see [Composer](https://getcomposer.org/)
    - via Docker to install Sail, see [Composer via Docker](https://hub.docker.com/_/composer)

### Start with Makefile

`cd` into the **truelayer** root folder.

Run
```bash
$ make install
```

Now you're ready to party!

Go to [localhost](http://localhost) and enjoy it.

## Tests
The tests run using PHPUnit, PHPcs and PHPstan.

### With Makefile

The next command will run PHPstan, PHPcs and PHPUnit
```bash
$ make test
```

