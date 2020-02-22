<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AirlockController extends Controller
{
    /**
     * Function modify the url csrf of Airlock in order to consistency.
     *
     * @return RedirectResponse|Redirector
     */
    public function csrf()
    {
        return redirect('/airlock/csrf-cookie');
    }

    /**
     * Function login to access route having middleware Airlock.
     * Using method loginUsingId to login.
     * And return a Bearer token if needed (for testing API on Postman).
     *
     * @return JsonResponse|bool
     */
    public function login()
    {
        $result = [
            'success' => true,
            'message' => 'Login Airlock successfully.'
        ];
        $airlockUserId = 2;

        if (!empty(request('token'))) {
            // Eject any requests from outside on production
            if (config('app.env') !== 'local') {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, TVQhub is not allowed any requests that not come from our side.'
                ]);
            } else {
                $token = User::find($airlockUserId)->createToken('token-airlock');
                $result['token'] = $token->plainTextToken;
            }
        } else {
            Auth::loginUsingId($airlockUserId);
        }

        return response()->json($result);
    }
}
