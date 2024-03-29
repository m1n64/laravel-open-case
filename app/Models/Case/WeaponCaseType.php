<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class WeaponCaseType extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function weaponCases(): HasMany
    {
        return $this->hasMany(WeaponCase::class, 'type_id');
    }
}
