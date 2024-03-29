<?php

namespace Database\Seeders;

use App\Models\Case\Collection;
use App\Models\Case\Skin;
use App\Models\Case\WeaponCase;
use App\Models\Case\Wear;
use App\Services\Cases\Collects\SkinsService;
use Illuminate\Database\Seeder;

class SkinsSeeder extends Seeder
{
    /**
     * @param SkinsService $collectSkinsService
     */
    public function __construct(
        protected SkinsService $collectSkinsService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skins = $this->collectSkinsService->getSkins();

        foreach ($skins as $skin) {
            $wears = $skin['wears'];
            $collections = $skin['collections'];
            $cases = $skin['cases'];

            $skinInfo = $skin;
            unset($skinInfo['wears']);
            unset($skinInfo['collections']);
            unset($skinInfo['cases']);

            $skin = Skin::create($skinInfo);

            $wearsIds = Wear::whereIn('cs_id', $wears)
                ->get()
                ->pluck('id');

            $skin->wears()->attach($wearsIds);


            $collectionsIds = Collection::whereIn('cs_id', $collections)
                ->get()
                ->pluck('id');
            $skin->collections()->attach($collectionsIds);


            $casesIds = WeaponCase::whereIn('cs_id', $cases)
                ->get()
                ->pluck('id');

            $skin->cases()->attach($casesIds);
        }
    }
}
