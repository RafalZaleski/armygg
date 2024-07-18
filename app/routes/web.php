<?php

use App\Modules\Pokedex\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PokedexController::class, 'index']);
Route::get('/{name}', [PokedexController::class, 'show']);
