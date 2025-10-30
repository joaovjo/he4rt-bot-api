<?php

declare(strict_types=1);

namespace Heart\User\Presentation\Controllers;

use App\Http\Controllers\Controller;
use Heart\User\Application\Exceptions\ProfileException;
use Heart\User\Application\FindProfile;
use Heart\User\Application\GetUser;
use Heart\User\Application\GetUsersPaginated;
use Heart\User\Application\UpdateProfile;
use Heart\User\Domain\Exceptions\UserEntityException;
use Heart\User\Presentation\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;

final class UsersController extends Controller
{
    public function getUsers(GetUsersPaginated $getUsers): JsonResponse
    {
        return response()->json($getUsers->handle());
    }

    public function getUser(int $id, GetUser $getUser): JsonResponse
    {
        try {
            return response()->json($getUser->handle($id));
        } catch (UserEntityException $userEntityException) {
            return response()->json(
                ['error' => $userEntityException->getMessage()],
                $userEntityException->getCode()
            );
        }
    }

    /**
     * @throws ProfileException
     */
    public function getProfile(string $value, FindProfile $profile): JsonResponse
    {
        return response()->json($profile->handle($value));
    }

    public function putProfile(
        UpdateProfileRequest $request,
        string $value,
        UpdateProfile $action,
    ): JsonResponse {
        $action->handle($value, $request->validated());

        return response()->json();
    }
}
