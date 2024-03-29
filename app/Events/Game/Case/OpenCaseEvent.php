<?php
declare(strict_types=1);

namespace App\Events\Game\Case;

use App\Models\Case\Skin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OpenCaseEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public int $caseId;

    /**
     * @var Skin
     */
    public Skin|null $skin;

    public bool $isKnife;

    public string $type;

    public float $coeff;

    /**
     * Create a new event instance.
     */
    public function __construct(
        int $caseId,
        Skin|null $skin,
        string $type,
        bool $isKnife,
        float $coeff,
    )
    {
        $this->caseId = $caseId;
        $this->skin = $skin;
        $this->coeff = $coeff;
        $this->type = $type;
        $this->isKnife = $isKnife;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('case.' . $this->caseId),
        ];
    }

    public function broadcastAs(): string
    {
        return 'case.open';
    }
}
