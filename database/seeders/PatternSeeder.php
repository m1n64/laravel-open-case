<?php

namespace Database\Seeders;

use App\Models\Case\Pattern;
use App\Services\Cases\Collects\SkinsService;
use Illuminate\Database\Seeder;

class PatternSeeder extends Seeder
{
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
        $patterns = $this->collectSkinsService->getPatterns();

        Pattern::insert(array_values($patterns));
    }
}
