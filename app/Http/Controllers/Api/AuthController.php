<?php

namespace EDU\Http\Controllers\Api;

use Illuminate\Http\Request;
use EDU\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
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


    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
        $usernameKey = $this->usernameKey();
        $data[$usernameKey] = $data[$this->username()];
        unset($data[$this->username()]);
        return $data;
    }

    protected function usernameKey()
    {
        $email = \Request::get($this->username());
        $validator = \Validator::make([
            'email' => $email
        ], ['email' => 'email']);
        return $validator->fails() ? 'enrolment' : 'email';
    }

    public function username()
    {
        return 'username';
    }

    // gerar o token
    public function accessToken(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if ($token = \Auth::guard('api')->attempt($credentials)) {
            return ['token' => $token];
        }

        return response()->json([
            'error' => \Lang::get('auth.failed')
        ],400);
    }

    // matar o token
    public function logout()
    {
        // dd(\Auth::guard('api')->check());

        \Auth::guard('api')->logout();
        return response()->json([], 204);
    }
}
