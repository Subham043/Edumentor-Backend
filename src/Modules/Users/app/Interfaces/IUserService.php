<?php

namespace Modules\Users\Interfaces;

use Modules\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IUserService
{

    public function all(): Collection;
    public function store(array $data): User;
    public function update(array $data, $id): User;
    public function getById($id): User;
    public function getByEmail(string $email): User;
    public function delete($id): bool|null;
    public function paginate(Int $total = 10): LengthAwarePaginator;

}
