<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\WeaponCaseType;

class CasesService extends CollectService
{
    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/crates.json';

    /**
     * @return array
     */
    public function getCases(): array
    {
        $cases = [];

        foreach ($this->response as $key => $value) {
            $csId = $value['id'];

            $type = WeaponCaseType::where('name', $value['type'])->first();

            $cases[$csId] = [
                'cs_id' => $csId,
                'name' => $value['name'],
                'description' => $value['description'],
                'type_id' => $type?->id,
                'image' => $value['image'],
            ];
        }

        return $cases;
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        $types = [];

        foreach ($this->response as $case) {
            $name = $case['type'];

            if ($name) {
                $types[$name] = [
                    'name' => $name,
                ];
            }
        }

        return $types;
    }
}
