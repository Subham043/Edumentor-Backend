<?php

namespace Modules\Authentications\Services;

use Illuminate\Support\Facades\Auth;
use Modules\Authentications\Interfaces\IAuthenticationService;
use Modules\Users\Models\User;
use Modules\Users\Services\UserService;

class AutheticationService implements IAuthenticationService
{
    public function __construct(private UserService $userService){}

    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function generate_token(User $user): string
    {
        return $user->createToken($user->email)->plainTextToken;
    }

    public function register(array $data): User
    {
        return $this->userService->store($data);
    }
}
