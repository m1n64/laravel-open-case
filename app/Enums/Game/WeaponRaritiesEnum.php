<?php
declare(strict_types=1);

namespace App\Enums\Game;

enum WeaponRaritiesEnum: string
{
    case COMMON = 'rarity_common_weapon';

    case UNCOMMON = 'rarity_uncommon_weapon';

    case RARE = 'rarity_rare_weapon';

    case MYTHICAL = 'rarity_mythical_weapon';

    case LEGENDARY = 'rarity_legendary_weapon';

    case ANCIENT = 'rarity_ancient_weapon';

    case CONTRABAND = 'rarity_contraband_weapon';
}
