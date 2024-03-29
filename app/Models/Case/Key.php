<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 * @property string|null $description
 * @property string $image
 */
class Key extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function cases(): HasMany
    {
        return $this->hasMany(WeaponCase::class);
    }
}
