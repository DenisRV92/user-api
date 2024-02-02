<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Exception;
use App\Services\UserServiceInterface;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{

    /**
     * @param RegisterRequest $request
     * @param UserServiceInterface $service
     * @return JsonResponse
     */
    public function register(RegisterRequest $request,UserServiceInterface $userService): JsonResponse
    {
        try {
            $token = $userService->register($request);
            return (new UserResource([
                'token' => $token,
                'message' => 'Successfully created user!'
            ]))
                ->response()
                ->setStatusCode(201);
        } catch (Exception $e) {
            return (new UserResource(['error' => 'Registration attempt failed']))
                ->response()
                ->setStatusCode(401);
        }
    }
}
