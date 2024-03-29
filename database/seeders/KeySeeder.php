<?php

namespace Database\Seeders;

use App\Models\Case\Key;
use App\Models\Case\WeaponCase;
use App\Services\Cases\Collects\KeysService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeySeeder extends Seeder
{
    /**
     * @param KeysService $keysService
     */
    public function __construct(
        protected KeysService $keysService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keys = $this->keysService->getKeys();

        foreach ($keys as $key) {
            $cases = $key['cases'];
            unset($key['cases']);

            $keyModel = Key::create($key);

            foreach ($cases as $caseId) {
                $case = WeaponCase::where('cs_id', $caseId)->first();

                if ($case) {
                    $case->key_id = $keyModel->id;
                    $case->save();
                }
            }
        }
    }
}
