<?php

namespace Modules\Roles\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Roles\Services\RoleService;
use Modules\Roles\Transformers\RoleCollection;

class RoleViewController extends Controller
{
    public function __construct(private RoleService $roleService){}

    /**
     * Show the specified resource.
     */
    public function __invoke($id)
    {
        $role = $this->roleService->getById($id);
        return response()->json(["message" => "Role fetched successfully.", "data" => RoleCollection::make($role)], 200);
    }
}
