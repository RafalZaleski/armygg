<?php

declare(strict_types=1);

namespace App\Modules\Pokedex\Services;

use App\Modules\Pokedex\Client;
use stdClass;

class PokedexService
{
    const PER_PAGE = 100;

    public function __construct(readonly private Client $client)
    {
    }

    public function index(): array
    {
        $meta['currentPage'] = max((int)request('page'), 1);
        
        $meta['search'] = request('search');

        $data = $this->client->getListAllPokemon();

        if ($meta['search']) {
            $meta['search'] = mb_strtolower($meta['search']);
            $newData = [];

            foreach ($data as $pokemon) {
                if (str_contains($pokemon->name, $meta['search'])) {
                    $newData[] = $pokemon;
                }
            }

            $data = $newData;
            unset($newData);
        }

        $meta['length'] = count($data);
        $meta['lastPage'] = (int)ceil($meta['length'] / self::PER_PAGE);

        if ($meta['currentPage'] > $meta['lastPage']) {
            $meta['currentPage'] = $meta['lastPage'];
        }

        return [
            'pokemons' => array_slice($data, ($meta['currentPage'] - 1) * self::PER_PAGE, self::PER_PAGE),
            'meta' => $meta,
        ];
    }

    public function show(string $name): stdClass
    {
        return $this->client->getPokemon($name);
    }

    public function toggleFavorite($name): string
    {
        $isFavorite = request()->cookie('isFavorite') ?? '';
        
        $isFavorite = explode(',', $isFavorite);
        if ($key = array_search($name, $isFavorite)) {
            unset($isFavorite[$key]);
        } else {
            $isFavorite[] = $name;
        }

        return implode(',', $isFavorite);
    }

    public function checkIsFavorite($name): bool
    {
        $isFavorite = request()->cookie('isFavorite') ?? '';
        $isFavorite = explode(',', $isFavorite);
        if (array_search($name, $isFavorite)) {
            return true;
        }

        return false;
    }

    public function showFavorites(): array
    {
        $isFavorite = request()->cookie('isFavorite') ?? '';
        $isFavorite = explode(',', $isFavorite);

        if (!is_array($isFavorite)) {
            $isFavorite = [];
        }
        
        return $isFavorite;
    }

}