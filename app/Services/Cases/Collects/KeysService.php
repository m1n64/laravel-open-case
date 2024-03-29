<?php

namespace App\Services\Cases\Collects;

class KeysService extends CollectService
{
    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/keys.json';

    /**
     * @return array
     */
    public function getKeys(): array
    {
        $keys = [];

        foreach ($this->response as $key) {
            $keyId = $key['id'];

            $cases = array_map(fn($case) => $case['id'], $key['crates']);

            $keys[$keyId] = [
                'cs_id' => $keyId,
                'name' => $key['name'],
                'description' => $key['description'],
                'image' => $key['image'],
                'cases' => $cases,
            ];
        }

        return $keys;
    }
}
