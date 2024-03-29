<?php

namespace App\Models\Weapon;

use App\Models\Case\Skin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 */
class Weapon extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function skin(): HasMany
    {
        return $this->hasMany(Skin::class, 'weapon_id');
    }
}
