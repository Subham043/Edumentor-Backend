<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Services\UserService;

class UserDeleteController extends Controller
{
    public function __construct(private UserService $userService){}

    /**
     * Remove the specified resource from storage.
     */
    public function __invoke($id)
    {

        try {
            //code...
            $this->userService->delete(
                $id
            );
            return response()->json(["message" => "User deleted successfully."], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }
}
