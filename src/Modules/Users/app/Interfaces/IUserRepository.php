<?php

namespace Modules\Users\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Modules\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IUserRepository
{

    public function query(): Builder;
    public function create(array $data): User;
    public function update(array $data, User $user): User;
    public function findById($id): User;
    public function findByEmail(string $email): User;
    public function delete(User $user): bool|null;
    public function syncRoles(array $roles = [], User $user): void;
    public function all(): Collection;
    public function paginate(Int $total = 10): LengthAwarePaginator;

}
