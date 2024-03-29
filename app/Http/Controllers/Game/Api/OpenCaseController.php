<?php

namespace App\Http\Controllers\Game\Api;

use App\Http\Actions\Game\Api\OpenCase\OpenAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class OpenCaseController extends Controller
{
    public function open(Request $request, OpenAction $action, int $id): JsonResponse
    {
        return $action($id);
    }
}
