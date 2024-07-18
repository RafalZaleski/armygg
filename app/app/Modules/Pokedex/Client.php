<?php

declare(strict_types=1);

namespace App\Modules\Pokedex;

use stdClass;
use Symfony\Component\HttpFoundation\Response;

class Client
{
    const LIST_ALL_POKEMON = 'pokemon?limit=2000';
    const GET_POKEMON = 'pokemon/';

    public function __construct(readonly private string $baseUrl = 'https://pokeapi.co/api/v2/')
    {
    }

    public function getListAllPokemon(): array
    {
        return $this->sendRequest($this->baseUrl . self::LIST_ALL_POKEMON)->results;
    }

    public function getPokemon(string $name): stdClass
    {
        return $this->sendRequest($this->baseUrl . self::GET_POKEMON . $name);
    }

    public function sendRequest(string $url): stdClass
    {

        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            throw new \Exception($url . $data, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return json_decode($data);
    }
}