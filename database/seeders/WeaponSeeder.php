<?php

namespace Database\Seeders;

use App\Models\Weapon\Weapon;
use App\Services\Cases\Collects\SkinsService;
use Illuminate\Database\Seeder;

class WeaponSeeder extends Seeder
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
        $weapons = $this->collectSkinsService->getWeapons();

        Weapon::insert(array_values($weapons));
    }
}
