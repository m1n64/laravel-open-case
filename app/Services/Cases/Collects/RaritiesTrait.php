<?php

namespace App\Services\Cases\Collects;

/**
 * @property array $response
 */
trait RaritiesTrait
{

    /**
     * @return array
     */
    public function getRarities(): array
    {
        $rarities = [];
        foreach ($this->response as $value) {
            $rarityId = $value['rarity']['id'];

            $rarities[$rarityId] = [
                'cs_id' => $rarityId,
                'name' => $value['rarity']['name'],
                'color' => $value['rarity']['color'],
            ];
        }

        return $rarities;
    }
}
