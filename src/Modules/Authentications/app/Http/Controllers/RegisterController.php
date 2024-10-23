<?php

namespace Modules\Authentications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Authentications\Http\Requests\RegisterRequest;
use Modules\Authentications\Services\AutheticationService;
use Modules\Authentications\Transformers\AutheticationCollection;

class RegisterController extends Controller
{
    public function __construct(private AutheticationService $autheticationService){}

    public function __invoke(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $user = $this->autheticationService->register(
                [
                    ...$request->validated(),
                    'role' => 'User',
                ]
            );
            return response()->json([
                "message" => "Registration completed successfully.",
                "data" => AutheticationCollection::make($user),
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        } finally {
            DB::commit();
        }
    }
}
