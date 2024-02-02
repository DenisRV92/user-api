<?php

namespace App\Services;

use App\Enums\RoleType;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function register(Request $request): string
    {
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => RoleType::fromString($request->role)->value
            ]);
            if ($user) {
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->plainTextToken;
                return $token;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
