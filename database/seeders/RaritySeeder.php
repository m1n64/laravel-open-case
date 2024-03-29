<?php

namespace Database\Seeders;

use App\Models\Case\Rarity;
use App\Services\Cases\Collects\AgentsService;
use App\Services\Cases\Collects\SkinsService;
use App\Services\Cases\Collects\StickersService;
use Illuminate\Database\Seeder;

class RaritySeeder extends Seeder
{
    /**
     * @param SkinsService $collectSkinsService
     * @param StickersService $collectStickersService
     * @param AgentsService $collectAgentsService
     */
    public function __construct(
        protected SkinsService $collectSkinsService,
        protected StickersService $collectStickersService,
        protected AgentsService $collectAgentsService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rarities = $this->collectSkinsService->getRarities();
        $otherRarities = $this->collectStickersService->getRarities();
        $agentsRarities = $this->collectAgentsService->getRarities();

        Rarity::insert(array_values($rarities + $agentsRarities + $otherRarities));
    }
}
