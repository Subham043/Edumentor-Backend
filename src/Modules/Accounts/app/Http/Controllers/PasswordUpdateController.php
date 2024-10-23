<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Accounts\Http\Requests\PasswordRequest;
use Modules\Accounts\Services\AccountService;

class PasswordUpdateController extends Controller
{
    public function __construct(private AccountService $accountService){}
    /**
     * Display a listing of the resource.
     */
    public function __invoke(PasswordRequest $request)
    {
        try {
            //code...
            $this->accountService->update(
                $request->safe()->only('password'),
                Auth::user()->id
            );
            return response()->json([
                'message' => "Password Updated successfully.",
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "something went wrong. Please try again",
            ], 400);
        }
    }
}
