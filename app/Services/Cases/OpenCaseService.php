<?php
declare(strict_types=1);

namespace App\Services\Cases;

use App\Enums\Game\WeaponCategoryEnum;
use App\Enums\Game\WeaponRaritiesEnum;
use App\Models\Case\WeaponCase;
use App\Services\Math\RandomService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\b;

class OpenCaseService
{
    /**
     * @param RandomService $randomService
     */
    public function __construct(
        protected RandomService $randomService,
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function open(int $id): void
    {
        $skinsList = WeaponCase::find($id)->skins()->with(['rarity', 'weapon', 'category', 'pattern']);

        $startTime = microtime(true);
        $runTime = 7; // 10 s

        $initialDelay = 100000; // 0.1 s
        $maxDelay = 5000000; // 0.5 s
        $slowDownStart = 3; // Время в секундах, когда начинается замедление
        //$slowDownDuration = $runTime - $slowDownStart; // Продолжительность замедления в секундах

        do {
            $skins = clone $skinsList;

            $coefficient = $this->randomService->cryptoRandFloatRange(0, 1);

            $rarirty = '';
            $isKnife = false;

            switch ($coefficient) {
                case 0 <= $coefficient && $coefficient <= 0.0026:
                    $rarirty = WeaponRaritiesEnum::ANCIENT;
                    $isKnife = true;
                    break;

                case 0.0026 < $coefficient && $coefficient <= 0.0064:
                    $rarirty = WeaponRaritiesEnum::ANCIENT;
                    break;

                case 0.0064 < $coefficient && $coefficient <= 0.032:
                    $rarirty = WeaponRaritiesEnum::LEGENDARY;
                    break;

                case 0.032 < $coefficient && $coefficient <= 0.16:
                    $rarirty = WeaponRaritiesEnum::MYTHICAL;
                    break;

                case 0.16 < $coefficient && $coefficient <= 1:
                    $rarirty = WeaponRaritiesEnum::RARE;
                    break;
            }

            $skin = $skins->whereHas('rarity', function ($query) use ($rarirty) {
                $query->where('cs_id', $rarirty->value);
            })
                ->whereHas('category', function ($query) use ($isKnife) {
                    if ($isKnife) {
                        $query->where('cs_id', WeaponCategoryEnum::MELEE->value);
                        $query->orWhere('cs_id', WeaponCategoryEnum::GLOVE->value);
                    } else {
                        $query->where('cs_id', '<>', WeaponCategoryEnum::MELEE->value);
                        $query->where('cs_id', '<>', WeaponCategoryEnum::GLOVE->value);
                    }
                })
                ->inRandomOrder($coefficient)
                ->first();

            if ($skin?->category()->first()->cs_id === WeaponCategoryEnum::MELEE->value || $skin?->category()->first()->cs_id === WeaponCategoryEnum::GLOVE->value) {
                $skin->image = Storage::url('knife.png');
                $skinRarirty = $skin->rarity;
                $skinRarirty->color = '#e4ae39';
            }

            event(new \App\Events\Game\Case\OpenCaseEvent($id, $skin, $rarirty->value, $isKnife, $coefficient));

            $elapsedTime = microtime(true) - $startTime;

            if ($elapsedTime > $slowDownStart) {
                $slowDownTime = $elapsedTime - $slowDownStart;
                $slowDownDuration = $runTime - $slowDownStart;

                $delayFraction = $slowDownTime / $slowDownDuration;
                $currentDelay = (int) ($initialDelay + ($maxDelay - $initialDelay) * $delayFraction);
            } else {
                $currentDelay = $initialDelay;
            }

            usleep(min($currentDelay, $maxDelay));
        } while ($elapsedTime < $runTime);
    }
}
