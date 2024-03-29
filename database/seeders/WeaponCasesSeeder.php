<?php

namespace Database\Seeders;

use App\Models\Case\WeaponCase;
use App\Services\Cases\Collects\CasesService;
use Illuminate\Database\Seeder;

class WeaponCasesSeeder extends Seeder
{
    /**
     * @param CasesService $collectCasesService
     */
    public function __construct(
        protected CasesService $collectCasesService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $weapons = $this->collectCasesService->getCases();

        WeaponCase::insert(array_values($weapons));
    }
}
