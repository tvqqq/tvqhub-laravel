<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Function login to access route having middleware Airlock.
     * Using method loginUsingId to login.
     * And return a Bearer token if needed (for testing API on Postman).
     *
     * @return \Illuminate\Http\JsonResponse|bool
     */
    public function loginAirlock()
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
        }
        else {
            Auth::loginUsingId($airlockUserId);
        }

        return response()->json($result);
    }
}
