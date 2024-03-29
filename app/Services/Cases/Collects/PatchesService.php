<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Rarity;

class PatchesService extends CollectService
{
    public const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/patches.json';

    /**
     * @return array
     */
    public function getPatches(): array
    {
        $patches = [];

        foreach ($this->response as $patch) {
            $csId = $patch['id'];

            $rarity = Rarity::where('cs_id', $patch['rarity']['id'])->first();

            $patches[$csId] = [
                'cs_id' => $csId,
                'name' => $patch['name'],
                'description' => $patch['description'],
                'image' => $patch['image'],
                'rarity_id' => $rarity?->id,
            ];
        }

        return $patches;
    }
}
