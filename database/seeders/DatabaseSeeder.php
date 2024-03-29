<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            WeaponSeeder::class,
            CategorySeeder::class,
            WeaponCaseTypeSeeder::class,
            WeaponCasesSeeder::class,
            KeySeeder::class,
            CollectionsSeeder::class,
            PatternSeeder::class,
            WearSeeder::class,
            RaritySeeder::class,
            SkinsSeeder::class,
            StickerSeeder::class,
            CollectibleSeeder::class,
            TeamSeeder::class,
            AgentSeeder::class,
            GraffitiSeeder::class,
            PatchSeeder::class,
        ]);
    }
}
