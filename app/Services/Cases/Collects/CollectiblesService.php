<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Rarity;

class CollectiblesService extends CollectService
{
    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/collectibles.json';

    /**
     * @return array
     */
    public function getCollectibles(): array
    {
        $collectibles = [];

        foreach ($this->response as $collectible) {
            $rarity = Rarity::where('cs_id', $collectible['rarity']['id'])->first();

            $csId = $collectible['id'];
            $collectibles[$csId] = [
                'cs_id' => $csId,
                'name' => $collectible['name'],
                'description' => $collectible['description'],
                'rarity_id' => $rarity?->id,
                'image' => $collectible['image'],
            ];
        }

        return $collectibles;
    }
}
