<?php

use App\Modules\Pokedex\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PokedexController::class, 'index']);
Route::get('/pokemon/{name}', [PokedexController::class, 'show']);
Route::get('/toggle-favorite/{name}', [PokedexController::class, 'toggleFavorite']);
Route::get('/favorites', [PokedexController::class, 'showFavorites']);
