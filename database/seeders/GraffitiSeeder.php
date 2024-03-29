<?php

namespace Database\Seeders;

use App\Models\Case\Graffiti;
use App\Models\Case\WeaponCase;
use App\Services\Cases\Collects\GraffitiService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraffitiSeeder extends Seeder
{
    /**
     * @param GraffitiService $graffitiService
     */
    public function __construct(
        protected GraffitiService $graffitiService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $graffities = $this->graffitiService->getGraffitis();

        foreach ($graffities as $graffiti) {
            $cases = $graffiti['cases'];
            unset($graffiti['cases']);

            $graffity = Graffiti::create($graffiti);

            $casesIds = WeaponCase::whereIn('cs_id', $cases)
                ->get()
                ->pluck('id');

            $graffity->cases()->attach($casesIds);
        }
    }
}
