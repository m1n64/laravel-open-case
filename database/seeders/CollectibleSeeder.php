<?php

namespace Database\Seeders;

use App\Models\Case\Collectible;
use App\Services\Cases\Collects\CollectiblesService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectibleSeeder extends Seeder
{
    /**
     * @param CollectiblesService $collectiblesService
     */
    public function __construct(
        protected CollectiblesService $collectiblesService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectibles = $this->collectiblesService->getCollectibles();

        Collectible::insert(array_values($collectibles));
    }
}
