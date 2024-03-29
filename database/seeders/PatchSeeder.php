<?php

namespace Database\Seeders;

use App\Models\Case\Patch;
use App\Services\Cases\Collects\PatchesService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatchSeeder extends Seeder
{
    /**
     * @param PatchesService $collectPatchesService
     */
    public function __construct(
        protected PatchesService $collectPatchesService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patches = $this->collectPatchesService->getPatches();

        Patch::insert($patches);
    }
}
