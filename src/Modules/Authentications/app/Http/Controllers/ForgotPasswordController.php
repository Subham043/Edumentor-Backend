<?php

namespace Modules\Authentications\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Modules\Authentications\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    public function __invoke(ForgotPasswordRequest $request)
    {
        $status = Password::sendResetLink(
            $request->safe()->only('email')
        );
        if($status === Password::RESET_LINK_SENT){
            return response()->json([
                'message' => __($status),
            ], 200);
        }
        return response()->json([
            'message' => __($status),
        ], 400);
    }
}
