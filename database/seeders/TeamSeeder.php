<?php

namespace Database\Seeders;

use App\Models\Game\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Team::insert([
            [
                'cs_id' => 'counter-terrorists',
                'name' => 'Спецназ',
            ],
            [
                'cs_id' => 'terrorists',
                'name' => 'Террористы',
            ]
        ]);
    }
}
