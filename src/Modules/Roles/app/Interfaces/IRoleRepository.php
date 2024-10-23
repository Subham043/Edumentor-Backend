<?php

namespace Modules\Roles\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IRoleRepository
{

    public function query(): Builder;
    public function findById($id): Role;
    public function all(): Collection;
    public function paginate(Int $total = 10): LengthAwarePaginator;

}
