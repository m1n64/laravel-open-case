<?php

namespace App\Services\Cases\Collects;

use App\Models\Case\Rarity;
use App\Models\Game\Team;

class AgentsService extends CollectService
{
    use RaritiesTrait;

    const API_URL = 'https://bymykel.github.io/CSGO-API/api/ru/agents.json';

    /**
     * @return array
     */
    public function getAgents(): array
    {
        $agents = [];

        foreach ($this->response as $agent) {
            $csId = $agent['id'];

            $rarity = Rarity::where('cs_id', $agent['rarity']['id'])->first();
            $team = Team::where('cs_id', $agent['team']['id'])->first();

            $collections = array_map(fn ($collection) => $collection['id'], $agent['collections']);

            $agents[$csId] = [
                'cs_id' => $csId,
                'name' => $agent['name'],
                'description' => $agent['description'],
                'rarity_id' => $rarity?->id,
                'team_id' => $team?->id,
                'image' => $agent['image'],
                'collections' => $collections,
            ];
        }

        return $agents;
    }
}
