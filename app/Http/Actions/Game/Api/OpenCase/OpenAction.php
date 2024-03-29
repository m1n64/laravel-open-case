<?php
declare(strict_types=1);

namespace App\Http\Actions\Game\Api\OpenCase;

use App\Services\Cases\OpenCaseService;
use Illuminate\Http\JsonResponse;

class OpenAction
{
    public function __construct(
        protected OpenCaseService $service,
    )
    {
    }

    public function __invoke(int $id): JsonResponse
    {
        $this->service->open($id);

        return response()
            ->json(['message' => 'OpenAction case ' . $id]);
    }
}
