<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Services\UserService;
use Modules\Users\Transformers\UserCollection;

class UserListController extends Controller
{
    public function __construct(private UserService $userService){}

    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $data = $this->userService->paginate($request->total ?? 10);
        return UserCollection::collection($data);
    }
}
