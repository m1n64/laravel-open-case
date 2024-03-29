<?php

namespace Database\Seeders;

use App\Models\Case\Sticker;
use App\Models\Case\WeaponCase;
use App\Services\Cases\Collects\StickersService;
use Illuminate\Database\Seeder;

class StickerSeeder extends Seeder
{

    /**
     * @param StickersService $collectStickers
     */
    public function __construct(
        protected StickersService $collectStickers,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stickers = $this->collectStickers->getStickers();

        foreach ($stickers as $sticker) {
            $stickerCases = $sticker['cases'];
            unset($sticker['cases']);

            $sticker = Sticker::create($sticker);

            $casesIds = WeaponCase::whereIn('cs_id', $stickerCases)
                ->get()
                ->pluck('id');

            $sticker->cases()->attach($casesIds);
        }
    }
}
