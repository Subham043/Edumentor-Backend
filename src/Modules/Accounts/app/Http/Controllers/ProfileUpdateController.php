<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Accounts\Http\Requests\ProfileRequest;
use Modules\Accounts\Services\AccountService;
use Modules\Accounts\Transformers\ProfileCollection;

class ProfileUpdateController extends Controller
{
    public function __construct(private AccountService $accountService){}
    /**
     * Display a listing of the resource.
     */
    public function __invoke(ProfileRequest $request)
    {
        $email_status = false;
        $phone_status = false;
        try {
            //code...
            $user = Auth::user();
            if($user->email != $request->email) {
                $email_status = true;
            }
            if($user->phone != $request->phone) {
                $phone_status = true;
            }
            $updated_user = $this->accountService->update(
                $request->validated(),
                $user
            );
            if ($email_status || $phone_status) {
                $updated_user->email_verified_at = null;
                $updated_user->save();
                $updated_user->sendEmailVerificationNotification();
            }

            return response()->json([
                'message' => "Profile Updated successfully.",
                'user' => ProfileCollection::make($updated_user),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "something went wrong. Please try again.",
            ], 400);
        }
    }
}
