<?php

namespace App\Services\Cases\Collects;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Casts\Json;

abstract class CollectService
{
    const API_URL = '';

    /**
     * @var array|mixed
     */
    protected array $response;

    /**
     * @throws GuzzleException
     */
    public function __construct()
    {
        $client = new Client();
        $request = $client->get(static::API_URL);
        $this->response = Json::decode($request->getBody()->getContents());
    }
}
