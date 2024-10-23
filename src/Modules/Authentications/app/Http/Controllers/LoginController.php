<?php

namespace Modules\Authentications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Authentications\Http\Requests\LoginRequest;
use Modules\Authentications\Services\AutheticationService;
use Modules\Authentications\Transformers\AutheticationCollection;

class LoginController extends Controller
{
    public function __construct(private AutheticationService $autheticationService){}

    public function __invoke(LoginRequest $request)
    {
        $is_authenticated = $this->autheticationService->login([...$request->validated(), 'is_banned' => false]);

        if ($is_authenticated) {
            $token = $this->autheticationService->generate_token(Auth::user());
            return response()->json([
                'message' => 'Logged in successfully.',
                'token_type' => 'Bearer',
                'token' => $token,
                'user' => AutheticationCollection::make(Auth::user()),
            ], 200);
        }
        return response()->json([
            'message' => 'Oops! You have entered invalid credentials',
        ], 400);
    }
}
