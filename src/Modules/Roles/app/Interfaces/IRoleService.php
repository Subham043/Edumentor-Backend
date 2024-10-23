<?php

namespace Modules\Roles\Interfaces;

use Spatie\Permission\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IRoleService
{

    public function all(): Collection;
    public function getById($id): Role;
    public function paginate(Int $total = 10): LengthAwarePaginator;

}
