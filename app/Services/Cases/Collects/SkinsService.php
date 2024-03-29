<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Pattern;
use App\Models\Case\Rarity;
use App\Models\Weapon\Category;
use App\Models\Weapon\Weapon;

class SkinsService extends CollectService
{
    use RaritiesTrait;

    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/skins.json';

    /**
     * @return array
     */
    public function getWeapons(): array
    {
        $weapons = [];
        foreach ($this->response as $key => $value) {
            $csId = $value['weapon']['id'];

            $weapons[$csId] = [
                'cs_id' => $csId,
                'name' => $value['weapon']['name'],
            ];
        }

        return $weapons;
    }

    /**
     * @return array
     */
    public function getPatterns(): array
    {
        $patterns = [];

        foreach ($this->response as $key => $value) {
            if ($value['pattern']) {
                $csId = $value['pattern']['id'];
                $patterns[$csId] = [
                    'cs_id' => $csId,
                    'name' => $value['pattern']['name'],
                ];
            }
        }
        return $patterns;
    }

    /**
     * @return array
     */
    public function getCategories(): array
    {
        $patterns = [];

        foreach ($this->response as $key => $value) {
            if ($value['category']) {
                $csId = $value['category']['id'];
                $patterns[$csId] = [
                    'cs_id' => $csId,
                    'name' => $value['category']['name'],
                ];
            }
        }

        return $patterns;
    }

    /**
     * @return array
     */
    public function getSkins(): array
    {
        $skin = [];
        foreach ($this->response as $key => $value) {
            $csId = $value['id'];

            $weapon = Weapon::where('cs_id', $value['weapon']['id'])->first();
            $category = Category::where('cs_id', $value['category']['id'])->first();

            $patternId = data_get($value, 'pattern.id');

            if ($patternId !== null) {
                $pattern = Pattern::where('cs_id', $patternId)->first();
            } else {
                $pattern = null;
            }

            $rarity = Rarity::where('cs_id', $value['rarity']['id'])->first();


            $wears = array_map(fn($wear) => $wear['id'], $value['wears'] ?? []);
            $collections = array_map(fn($collection) => $collection['id'], $value['collections'] ?? []);
            $cases = array_map(fn($case) => $case['id'], $value['crates'] ?? []);

            $skin[$csId] = [
                'skin_id' => $csId,
                'name' => $value['name'],
                'description' => $value['description'],
                'image' => $value['image'],
                'stattrak' => $value['stattrak'],
                'souvenir' => $value['souvenir'] ?? false,
                'paint_index' => (int) $value['paint_index'],
                'min_float' => $value['min_float'],
                'max_float' => $value['max_float'],
                'weapon_id' => $weapon->id,
                'category_id' => $category->id,
                'rarity_id' => $rarity->id,
                'pattern_id' => $pattern?->id,
                'wears' => $wears,
                'collections' => $collections,
                'cases' => $cases,
            ];
        }

        return $skin;
    }
}
