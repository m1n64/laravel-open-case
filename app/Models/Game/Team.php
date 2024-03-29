<?php

namespace App\Models\Game;

use App\Models\Case\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $cs_id
 * @property string $name
 */
class Team extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class, 'team_id');
    }
}
