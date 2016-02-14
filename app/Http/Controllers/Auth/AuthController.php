<?php

namespace App\Http\Controllers\Auth;

use App\Http\AuthTraits\ManagesSocial;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottesLogins;
use App\Exceptions\NoActiveAccountException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Exceptions\ConnectionNotAcceptedException;
use App\Exceptions\EmailNotProvidedException;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ManagesSocial;

    private $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => [
                                        'getLogout',
                                        'handleProviderCallback',
                                        'redirectToProvider']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['is_subscribed'] = empty($data['is_subscribed']) ? 0 : 1;
        $data['terms'] = empty($data['terms']) ? 0 : 1;

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'is_subscribed' => 'boolean',
            'password' => 'required|confirmed|min:6',
            'terms' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {   
        $data['is_subscribed'] = empty($data['is_subscribed']) ? 0 : 1;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_subscribed' => $data['is_subscribed'],
            'password' => bcrypt($data['password']),
        ]);
    }

        /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $this->checkStatusLevel();
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    private function checkStatusLevel() {

        if ( ! Auth::user()->isActiveStatus()) {
            Auth::logout();
            throw new \App\Exceptions\NoActiveAccountException;
        }
    }

    /**
    * Get the post register / login redirect path.
    *
    * @return string
    */
    public function redirectPath()
    {
        if (Auth::user()->isAdmin()) {
            return 'admin';
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    /**
    * Redirect the user to the Facebook authentication page
    *
    * @return Response
    */
    public function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();
    }

    /**
    * Obtain the user information from Facebook
    *
    * @return Response
    */
    public function handleProviderCallback() {
        try {
            $socialUser = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            throw new ConnectionNotAcceptedException;
        }

        $facebookEmail = $socialUser->getEmail();

        if ($this->socialUserHasNo($facebookEmail)) {
            throw new EmailNotProvidedException;
        }

        if ($this->socialUserAlreadyLoggedIn()) {
            $this->userSyncedOrSync($socialUser);
        }

        $authUser = $this->findOrCreateUser($socialUser);

        Auth::login($authUser, true);

        $this->checkStatusLevel();

        return $this->redirectUser();
    }

}
