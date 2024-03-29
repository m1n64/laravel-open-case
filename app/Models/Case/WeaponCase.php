<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 * @property string|null $description
 * @property int|null $type_id
 * @property int|null $key_id
 * @property string $image
 */
class WeaponCase extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(WeaponCaseType::class, 'id');
    }

    /**
     * @return BelongsTo
     */
    public function key(): BelongsTo
    {
        return $this->belongsTo(Key::class);
    }

    /**
     * @return BelongsToMany
     */
    public function skins(): BelongsToMany
    {
        return $this->belongsToMany(Skin::class, 'weapon_case_skin');
    }

    /**
     * @return BelongsToMany
     */
    public function stickers(): BelongsToMany
    {
        return $this->belongsToMany(Sticker::class, 'weapon_case_sticker');
    }

    /**
     * @return BelongsToMany
     */
    public function graffities(): BelongsToMany
    {
        return $this->belongsToMany(Graffiti::class, 'weapon_case_graffiti');
    }
}
