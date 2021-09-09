# TrueLayer

## Index

- [Project](#project)
- [Prerequisites](#prerequisites)
- [Start with makefile](#start-with-makefile)
- [Endpoints](#caching)
- [Caching](#caching)
- [Tests](#tests)
    - [With Makefile](#with-makefile)
- [Lifecycle](#lifecycle)
- [Production TODO](#production-todo)

## Project

The project is based on [Laravel 8](https://laravel.com/docs/8.x) and uses PHP8.

## Prerequisites

- [Docker](https://docker.com) installed to run it using Sail.

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
GET http://localhost/pokemon/{name}
```

Get a translated one:
```
GET  http://localhost/pokemon/translated/{name}
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

### Lifecycle

The lifecycle of a request is the following one:
- Laravel use the Dependency Inkection binding the concrete classes to the interfaces you that you can find in *app/Providers/AppServiceProvider.php*;
- Looks for the routes in *routes/api.php*;
```
Route::prefix('pokemon')->middleware(['force_json'])->group(function () {
    Route::get('{name}', [App\Http\Controllers\PokemonController::class, 'basic'])
        ->name('pokemon.basic');
    Route::get('translated/{name}', [App\Http\Controllers\PokemonController::class, 'translated'])
        ->name('pokemon.translated');
});
```
- Once the route is matched, it invokes the relative method in the controller, like the method `basic` in *app/Http/Controllers/PokemonController.php*.
```
public function basic(string $name): JsonResponse
    {
        return response()->json(
            $this->pokemonMaster->getBasicInfo($name)
        );
    }
```
The `pokemonMaster` property is injected thanks to the DI.
- The PokemonMaster, that concretely is *app/Libraries/PokemonMaster/TrueLayer.php*, look for the requested Pokemon.


## Production TODO

To run it in production the following steps should be implemented:
- Basic Auth on APIs;
- Improve caching system, e.g. using Redis;
- Insert APIs docs;
- Improve and insert missing tests;
- Differentiate log files, e.g. inserting one to log requests to POKEAPI, ...;
- Check which packages in composer and in dockerfile are strictly needed.
