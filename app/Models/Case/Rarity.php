<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 * @property string $color
 */
class Rarity extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function skins(): HasMany
    {
        return $this->hasMany(Skin::class, 'rarity_id');
    }

    /**
     * @return HasMany
     */
    public function stickers(): HasMany
    {
        return $this->hasMany(Sticker::class, 'rarity_id');
    }

    /**
     * @return HasMany
     */
    public function collectibles(): HasMany
    {
        return $this->hasMany(Collectible::class, 'rarity_id');
    }

    /**
     * @return HasMany
     */
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'rarity_id');
    }

    /**
     * @return HasMany
     */
    public function graffities(): HasMany
    {
        return $this->hasMany(Graffiti::class, 'rarity_id');
    }

    /**
     * @return HasMany
     */
    public function patches(): HasMany
    {
        return $this->hasMany(Patch::class, 'rarity_id');
    }
}
