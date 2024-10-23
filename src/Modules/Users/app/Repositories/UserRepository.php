<?php

namespace Modules\Users\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Modules\Users\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Collection;
use Modules\Users\Interfaces\IUserRepository;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;

class UserRepository implements IUserRepository
{
    public function query(): Builder
    {
        return User::with('roles')->latest();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(array $data, User $user): User
    {
        $user->update($data);
        $user->refresh();
        return $user;
    }

    public function findById($id): User
    {
        return $this->query()->findOrFail($id);
    }

    public function findByEmail(string $email): User
    {
        return $this->query()->where('email', $email)->firstOrFail();
    }

    public function delete(User $user): bool|null
    {
        return $user->delete();
    }

    public function syncRoles(array $roles = [], User $user): void
    {
        $user->syncRoles($roles);
    }

    public function all(): Collection
    {
        return $this->query()->lazy(100)->collect();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        return QueryBuilder::for($this->query())
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }
}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where(function($q) use($value){
            $q->where('name', 'LIKE', '%' . $value . '%')
            ->orWhere('email', 'LIKE', '%' . $value . '%');
        });
    }
}
