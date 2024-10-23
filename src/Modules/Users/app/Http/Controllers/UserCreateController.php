<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Http\Requests\UserCreateRequest;
use Modules\Users\Services\UserService;
use Illuminate\Support\Facades\DB;
use Modules\Users\Transformers\UserCollection;

class UserCreateController extends Controller
{

    public function __construct(private UserService $userService){}

    /**
     * Store a newly created resource in storage.
     */
    public function __invoke(UserCreateRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $user = $this->userService->store(
                [
                    ...$request->validated(),
                ]
            );
            return response()->json([
                "message" => "User created successfully.",
                "data" => UserCollection::make($user),
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        } finally {
            DB::commit();
        }
    }
}
