<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
//        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if (Auth::check() && (Auth::user()->id !== $user->id)) {
            $name = Auth::user()->name;
            Auth::guard()->logout();
            $request->session()->invalidate();
            flash(__('messages.ended_session', ['name' => $name]))->warning();
        }

//        if ($request->route('id') != $request->user()->getKey()) {
//            throw new AuthorizationException;
//        }

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        flash(__('messages.verified'))->success();

        if (!$user->hasSetPassword()) {
            return redirect(URL::temporarySignedRoute('password.set', now()->addMinutes(20)));
        }

        if (Auth::guest()) {
            $this->guard()->login($user);
            flash(__('messages.authenticated'))->success();
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

}
