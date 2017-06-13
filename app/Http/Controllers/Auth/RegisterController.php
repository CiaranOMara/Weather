<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as registerTrait;
    }

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Normalise email.
        if ($email = $request->input('email', false)) {
            $request->merge(['email' => Str::lower($email)]);
        }

        return $this->registerTrait($request);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showSetPasswordForm()
    {
        return view('auth.passwords.set');
    }

    public function setPassword(Request $request)
    {

        $this->validate($request, [
            'verification_token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($user = User::where('verification_token', $request->input('verification_token'))->first()) {

            $user->password = bcrypt($request->input('password'));

            $user->confirmEmail();

            Log::info("Email address verified and password set:", ['email' => $user->email]);

            Flash::success('Your email address has been verified and your password has been set.')->important();

            $this->guard()->login($user);

            return redirect($this->redirectPath());
        }

        Log::error("Email address verification token not found:", ['request' => $request->toArray()]);

        Flash::error('Something went wrong.')->important();

        return redirect()->route('login');
    }

    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        if ($user = User::where('verification_token', $token)->first()) {

            // Prompt migrated user set password.
            if ($user->password == 'password') {

                // Route user to modified reset password form.
                Flash::info("Please set your password.")->important();

                return redirect()->route('password.set')->withInput([
                    'verification_token' => $token,
                ]);

            }

            $user->confirmEmail();

            Log::info("Email address verified:", ['email' => $user->email]);

            Flash::success('Your email address has now been verified')->important();

            $this->guard()->login($user);

            return redirect($this->redirectPath());

        }

        Log::info("Email address verification token not found:", ['token' => $token]); //Note: this will be a user error.

        Flash::warning('Your email address may have already been verified. The token provided was not found and may have already been used.')->important();

        return redirect()->route('login');
    }

}
