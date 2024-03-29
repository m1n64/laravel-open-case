<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 */
class Pattern extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function skin(): HasMany
    {
        return $this->hasMany(Skin::class, 'pattern_id');
    }
}
