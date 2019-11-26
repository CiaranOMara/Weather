<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Laracasts\Flash\FlashNotifier;
use Laracasts\Flash\LaravelSessionStore;
use Laracasts\Flash\Message;


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

    use AuthenticatesUsers {
        credentials as traitCredentials;
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    public function authenticated(Request $request, $user)
    {
        flash(__('messages.authenticated'))->success();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        flash(__('messages.loggedout'))->success();
    }

//    /**
//     * Get the needed authorization credentials from the request.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return array
//     */
//    protected function credentials(Request $request)
//    {
//        $credentials = $this->traitCredentials($request);
//
//        $credentials['verified'] = true;
//
//        return $credentials;
//    }
}
