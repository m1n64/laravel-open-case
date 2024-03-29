<?php

namespace Database\Seeders;

use App\Models\Weapon\Category;
use App\Services\Cases\Collects\SkinsService;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
        $categories = $this->collectSkinsService->getCategories();

        Category::insert(array_values($categories));
    }
}
