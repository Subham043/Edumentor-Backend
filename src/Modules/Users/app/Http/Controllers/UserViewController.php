<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Services\UserService;
use Modules\Users\Transformers\UserCollection;

class UserViewController extends Controller
{
    public function __construct(private UserService $userService){}

    /**
     * Show the specified resource.
     */
    public function __invoke($id)
    {
        $user = $this->userService->getById($id);
        return response()->json(["message" => "User fetched successfully.", "data" => UserCollection::make($user)], 200);
    }
}
