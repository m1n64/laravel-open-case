<?php
declare(strict_types=1);

namespace App\Enums\Game;

enum WeaponCategoryEnum: string
{
    case PISTOL = 'csgo_inventory_weapon_category_pistols';

    case RIFLE = 'csgo_inventory_weapon_category_rifles';

    case HEAVY = 'csgo_inventory_weapon_category_heavy';

    case SMG = 'csgo_inventory_weapon_category_smgs';

    case MELEE = 'sfui_invpanel_filter_melee';

    case GLOVE = 'sfui_invpanel_filter_gloves';
}
