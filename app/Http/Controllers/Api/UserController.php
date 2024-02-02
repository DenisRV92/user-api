<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
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
    public function register(RegisterRequest $request, UserServiceInterface $service): JsonResponse
    {
        try {
            $token = $service->register($request);
            return response()->json([
                'token' => $token,
                'message' => 'Successfully created user!'
            ], 201);
        } catch (Exception $e) {
            return response()->json(['error' => 'Registration attempt failed'], 401);
        }

    }

}
