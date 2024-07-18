<?php

declare(strict_types=1);

namespace App\Modules\Pokedex\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pokedex\Services\PokedexService;
use Illuminate\Contracts\View\View;

class PokedexController extends Controller
{
    public function __construct(private readonly PokedexService $pokedexService)
    {
    }

    public function index(): View
    {
        $data = $this->pokedexService->index();
        
        return view('list', ['pokemons' => $data]);
    }

    public function show(string $name): View
    {        
        $data = $this->pokedexService->show($name);

        return view('show', ['pokemon' => $data]);
    }
}
