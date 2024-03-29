<?php

namespace App\Models\Case;

use App\Models\Weapon\Category;
use App\Models\Weapon\Weapon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $skin_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property boolean $stattrak
 * @property boolean $souvenir
 * @property double $min_float
 * @property double $max_float
 * @property int $weapon_id
 * @property int $category_id
 * @property int $rarity_id
 * @property int $pattern_id
 */
class Skin extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function weapon(): BelongsTo
    {
        return $this->belongsTo(Weapon::class, 'weapon_id');
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function rarity(): BelongsTo
    {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    /**
     * @return BelongsTo
     */
    public function pattern(): BelongsTo
    {
        return $this->belongsTo(Pattern::class, 'pattern_id');
    }

    /**
     * @return BelongsToMany
     */
    public function wears(): BelongsToMany
    {
        return $this->belongsToMany(Wear::class, 'skin_wear');
    }

    /**
     * @return BelongsToMany
     */
    public function collections(): BelongsToMany
    {
        return $this->belongsToMany(Collection::class, 'collection_skin');
    }

    /**
     * @return BelongsToMany
     */
    public function cases(): BelongsToMany
    {
        return $this->belongsToMany(WeaponCase::class, 'weapon_case_skin');
    }
}
