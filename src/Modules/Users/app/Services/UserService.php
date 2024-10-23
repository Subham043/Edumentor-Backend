<?php

namespace Modules\Users\Services;

use Modules\Users\Models\User;
use Modules\Users\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Users\Interfaces\IUserService;
use Illuminate\Database\Eloquent\Collection;

class UserService implements IUserService
{
    public function __construct(private UserRepository $userRepository){}

    public function store(array $data): User
    {
        $user = $this->userRepository->create($data);
        $this->userRepository->syncRoles([$data['role']], $user);
        $user->sendEmailVerificationNotification();
        return $user;
    }

    public function update(array $data, $id): User
    {
        $user = $this->getById($id);
        $this->userRepository->syncRoles([$data['role']], $user);
        if(empty($data['password'])){
            unset($data['password']);
        }
        return $this->userRepository->update($data, $user);
    }

    public function getById($id): User
    {
        return $this->userRepository->findById($id);
    }

    public function getByEmail(String $email): User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function delete($id): bool
    {
        $user = $this->getById($id);
        return $this->userRepository->delete($user);
    }

    public function all(): Collection
    {
        return $this->userRepository->all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        return $this->userRepository->paginate($total);
    }
}
