<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Rarity;

class GraffitiService extends CollectService
{
    public const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/graffiti.json';

    /**
     * @return array
     */
    public function getGraffitis(): array
    {
        $graffitis = [];
        foreach ($this->response as $graffiti) {
            $csId = $graffiti['id'];

            $rarity = Rarity::where('cs_id', $graffiti['rarity']['id'])->first();

            $cases = array_map(fn ($case) => $case['id'], $graffiti['crates']);

            $graffitis[$csId] = [
                'cs_id' => $csId,
                'name' => $graffiti['name'],
                'description' => $graffiti['description'],
                'image' => $graffiti['image'],
                'rarity_id' => $rarity?->id,
                'cases' => $cases,
            ];
        }

        return $graffitis;
    }
}
