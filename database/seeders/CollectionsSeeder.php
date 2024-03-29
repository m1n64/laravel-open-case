<?php

namespace Database\Seeders;

use App\Models\Case\Collection;
use App\Services\Cases\Collects\CollectionService;
use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * @param CollectionService $collectCollectionService
     */
    public function __construct(
        protected CollectionService $collectCollectionService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = $this->collectCollectionService->getCollections();

        Collection::insert(array_values($collections));
    }
}
