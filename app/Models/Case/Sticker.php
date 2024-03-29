<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 * @property string|null $description
 * @property int $rarity_id
 * @property string $image
 */
class Sticker extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function rarity(): BelongsTo
    {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    /**
     * @return BelongsToMany
     */
    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(WeaponCase::class, 'weapon_case_sticker');
    }
}
