<?php

namespace App\Services\Cases\Collects;

class CollectionService extends CollectService
{
    public const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/collections.json';

    /**
     * @return array
     */
    public function getCollections(): array
    {
        $collections = [];
        foreach ($this->response as $key => $value) {
            $csId = $value['id'];
            $collections[$csId] = [
                'cs_id' => $csId,
                'name' => $value['name'],
                'image' => $value['image'],
            ];
        }

        return $collections;
    }
}
