<?php

namespace Database\Seeders;

use App\Models\Case\Wear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Database\Seeder;

class WearSeeder extends Seeder
{
    const WEARS_JSON = '[
            {
                "cs_id": "SFUI_InvTooltip_Wear_Amount_0",
                "name": "Прямо с завода"
            },
            {
                "cs_id": "SFUI_InvTooltip_Wear_Amount_1",
                "name": "Немного поношенное"
            },
            {
                "cs_id": "SFUI_InvTooltip_Wear_Amount_2",
                "name": "После полевых испытаний"
            },
            {
                "cs_id": "SFUI_InvTooltip_Wear_Amount_3",
                "name": "Поношенное"
            },
            {
                "cs_id": "SFUI_InvTooltip_Wear_Amount_4",
                "name": "Закалённое в боях"
            }
        ]';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wears = Json::decode(self::WEARS_JSON);

        Wear::insert($wears);
    }
}
