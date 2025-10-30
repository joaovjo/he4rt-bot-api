<?php

namespace He4rt\Badge\Http\Controllers;

use App\Http\Controllers\Controller;
use He4rt\Badge\Actions\CreateBadge;
use He4rt\Badge\Actions\DeleteBadge;
use He4rt\Badge\Http\Requests\CreateBadgeRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BadgesController extends Controller
{
    public function getBadges()
    {
    }

    public function postBadge(
        CreateBadgeRequest $request,
        CreateBadge $persistBadge
    ): JsonResponse {
        return response()->json(
            $persistBadge->handle($request->validated()),
            Response::HTTP_CREATED
        );
    }

    public function deleteBadge(string $badgeId, DeleteBadge $deleteBadge): Response
    {
        $deleteBadge->handle($badgeId);

        return response()->noContent();
    }
}