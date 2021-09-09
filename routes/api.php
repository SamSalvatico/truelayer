<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('pokemon')->middleware(['force_json'])->group(function () {
    Route::get('{name}', [App\Http\Controllers\PokemonController::class, 'basic'])
        ->name('pokemon.basic');
    Route::get('translated/{name}', [App\Http\Controllers\PokemonController::class, 'translated'])
        ->name('pokemon.translated');
});
