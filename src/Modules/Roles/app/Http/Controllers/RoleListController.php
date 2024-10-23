<?php

namespace Modules\Roles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Roles\Services\RoleService;
use Modules\Roles\Transformers\RoleCollection;

class RoleListController extends Controller
{
    public function __construct(private RoleService $roleService){}

    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $data = $this->roleService->paginate($request->total ?? 10);
        return RoleCollection::collection($data);
    }
}
