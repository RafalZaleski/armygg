<?php

declare(strict_types=1);

namespace App\Modules\Pokedex\Services;

use App\Modules\Pokedex\Client;
use stdClass;

class PokedexService
{
    public function __construct(readonly private Client $client)
    {
    }

    public function index(): array
    {
        return $this->client->getListAllPokemon();
    }

    public function show(string $name): stdClass
    {
        return $this->client->getPokemon($name);
    }
}