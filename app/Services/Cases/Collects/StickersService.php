<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Rarity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Casts\Json;

class StickersService extends CollectService
{
    use RaritiesTrait;

    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/stickers.json';

    /**
     * @return array
     */
    public function getStickers(): array
    {
        $stickers = [];
        foreach ($this->response as $key => $value) {
            $csId = $value['id'];

            $rarity = Rarity::where('cs_id', $value['rarity']['id'])->first();

            $cases = array_map(fn($case) => $case['id'], $value['crates']);

            $stickers[$csId] = [
                'cs_id' => $csId,
                'name' => $value['name'],
                'description' => $value['description'],
                'rarity_id' => $rarity?->id,
                'image' => $value['image'],
                'cases' => $cases,
            ];
        }

        return $stickers;
    }
}
