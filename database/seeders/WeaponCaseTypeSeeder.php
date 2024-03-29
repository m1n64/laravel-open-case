<?php

namespace Database\Seeders;

use App\Models\Case\WeaponCaseType;
use App\Services\Cases\Collects\CasesService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeaponCaseTypeSeeder extends Seeder
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
        $types = $this->collectCasesService->getTypes();

        WeaponCaseType::insert(array_values($types));
    }
}
