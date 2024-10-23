<?php

namespace Modules\Accounts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Accounts\Transformers\ProfileCollection;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'user' => ProfileCollection::make(Auth::user()),
        ], 200);
    }
}
