<?php

namespace App\Models\Case;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 * @property string $image
 */
class Collection extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function skins(): BelongsToMany
    {
        return $this->belongsToMany(Skin::class, 'collection_skin');
    }

    /**
     * @return BelongsToMany
     */
    public function agents(): BelongsToMany
    {
        return $this->belongsToMany(Agent::class, 'collection_agent');
    }
}
