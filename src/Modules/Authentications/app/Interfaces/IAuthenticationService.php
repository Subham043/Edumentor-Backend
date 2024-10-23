<?php

namespace Modules\Authentications\Interfaces;

use Modules\Users\Models\User;

interface IAuthenticationService
{

    public function login(array $credentials): bool;
    public function generate_token(User $user): string;
    public function register(array $data): User;

}
