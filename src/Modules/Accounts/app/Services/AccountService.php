<?php

namespace Modules\Accounts\Services;

use Modules\Users\Models\User;
use Modules\Users\Services\UserService;

class AccountService
{
    public function __construct(private UserService $userService){}

    public function update(array $data, $id): User
    {
        return $this->userService->update($data, $id);
    }
}
