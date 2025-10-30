<?php

declare(strict_types=1);

namespace Heart\Provider\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Heart\Provider\Application\NewAccountByProvider;
use Heart\Provider\Domain\Enums\ProviderEnum;
use Heart\Provider\Presentation\Requests\CreateProviderRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ProvidersController extends Controller
{
    public function postProvider(
        CreateProviderRequest $request,
        string $provider,
        NewAccountByProvider $action,
    ): JsonResponse {
        $response = $action->handle(
            ProviderEnum::from($provider),
            $request->input('provider_id'),
            $request->input('username')
        );

        return response()->json($response, Response::HTTP_CREATED);
    }
}
