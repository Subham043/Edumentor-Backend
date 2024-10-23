<?php

namespace Modules\Roles\Services;

use Spatie\Permission\Models\Role;
use Modules\Roles\Repositories\RoleRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Roles\Interfaces\IRoleService;
use Illuminate\Database\Eloquent\Collection;

class RoleService implements IRoleService
{
    public function __construct(private RoleRepository $roleRepository){}

    public function all(): Collection
    {
        return $this->roleRepository->all();
    }

    public function getById($id): Role
    {
        return $this->roleRepository->findById($id);
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        return $this->roleRepository->paginate($total);
    }
}
