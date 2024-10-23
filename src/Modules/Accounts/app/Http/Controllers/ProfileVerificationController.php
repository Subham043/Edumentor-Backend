<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Accounts\Http\Requests\EmailVerificationRequest;

class ProfileVerificationController extends Controller
{
    public function resend_notification(Request $request){
        if($request->user()->hasVerifiedEmail()){
            return response()->json([
                'message' => 'Oops! you are already a verified user.',
            ], 400);
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json([
            'message' => 'Verification link sent to your registered email.',
        ], 200);
    }

    public function verify_email(EmailVerificationRequest $request, $id, $hash){
        $request->fulfill();
        return redirect(config('app.main_url').'?verified=true');
    }
}
