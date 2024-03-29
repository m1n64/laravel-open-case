<?php

namespace Database\Seeders;

use App\Models\Case\Agent;
use App\Models\Case\Collection;
use App\Services\Cases\Collects\AgentsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * @param AgentsService $agentsService
     */
    public function __construct(
        protected AgentsService $agentsService,
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agents = $this->agentsService->getAgents();

        foreach ($agents as $agent) {
            $collections = $agent['collections'];
            unset($agent['collections']);

            $agent = Agent::create($agent);

            $collectionsIds = Collection::whereIn('cs_id', $collections)
                ->get()
                ->pluck('id');

            $agent->collections()->attach($collectionsIds);
        }
    }
}
