<?php

declare(strict_types=1);

namespace App\Modules\Pokedex\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pokedex\Services\PokedexService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PokedexController extends Controller
{
    public function __construct(private readonly PokedexService $pokedexService)
    {
    }

    public function index(): View
    {
        $data = $this->pokedexService->index();
        
        return view('list', ['pokemons' => $data['pokemons'], 'meta' => $data['meta']]);
    }

    public function show(string $name): View
    {        
        $data = $this->pokedexService->show($name);
        $isFavorite = $this->pokedexService->checkIsFavorite($name);

        return view('show', ['pokemon' => $data, 'isFavorite' => $isFavorite]);
    }

    public function toggleFavorite($name): RedirectResponse
    {
        $cookie = $this->pokedexService->toggleFavorite($name);

        return redirect('/pokemon/' . $name)->cookie('isFavorite', $cookie);
    }

    public function showFavorites(): View
    {
        $data = $this->pokedexService->showFavorites();
        
        return view('favorite', ['pokemons' => $data]);
    }
}
