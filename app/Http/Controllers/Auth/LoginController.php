<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

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
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // User not enable 2FA
        if (!($secret = $user->google2fa_secret)) {
            return false; // authenticated
        }

        // Verify 2FA
        $otp = request('otp') ?? '';
        if (!$otp) {
            return $this->otpError($request, 'This account has enabled 2FA');
        }
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($secret, $otp);
        if (!$valid) {
            return $this->otpError($request, 'Wrong OTP. Please try again!');
        }
    }

    private function otpError($request, $message)
    {
        auth()->logout();
        return back()->withErrors(['otp' => $message])->withInput();
    }
}
