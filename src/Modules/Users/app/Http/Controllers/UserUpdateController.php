<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Users\Http\Requests\UserUpdateRequest;
use Modules\Users\Services\UserService;
use Illuminate\Support\Facades\DB;
use Modules\Users\Transformers\UserCollection;

class UserUpdateController extends Controller
{
    public function __construct(private UserService $userService){}

    /**
     * Update the specified resource in storage.
     */
    public function __invoke(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $user = $this->userService->update(
                $request->validated(),
                $id
            );
            return response()->json(["message" => "User updated successfully.", "data" => UserCollection::make($user)], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        } finally {
            DB::commit();
        }
    }
}
