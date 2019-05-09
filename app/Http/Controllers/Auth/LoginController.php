<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException as ValidationExceptionAlias;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
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
    protected $redirectTo = '/';

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
     * Handle a login request to the application.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Response|\Symfony\Component\HttpFoundation\Response|void
     *
     * @throws ValidationExceptionAlias
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        if ($this->attemptLoginByOldPasswordEncryption($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param Request $request
     * @return void
     *
     * @throws ValidationExceptionAlias
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = array(
            'status' => 0,
            'password' => $request->input('password')
        );

        $validator = Validator::make($request->all(), [
            $this->username() => 'email',
        ]);

        if ($validator->fails()) {
            $credentials = array_merge($credentials, ['username' => $request->input('identification')]);
        } else {
            $credentials = array_merge($credentials, ['email' => $request->input('identification')]);
        }

        return $credentials;
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'identification';
    }

    /**
     * Attempt to log the user into the application by old password encryption.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptLoginByOldPasswordEncryption(Request $request)
    {

        $validator = Validator::make($request->all(), [
            $this->username() => 'mail',
        ]);

        if ($validator->fails()) {
            $user = User::where('username', $request->input('identification'));
        } else {
            $user = User::where('email', $request->input('identification'));
        }

        $user = $user->where('status', 0)->first();

        if (is_null($user)) return false;

        if ($this->oldPasswordEncryptionCheck($request->input('password'), $user->password) === false) {
            return false;
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();
        Log::info('user: {} password have been change encryption.', $user->username);

        $this->guard()->login($user, $request->filled('remember'));

        return true;

    }

    /**
     * Check password is correct by old encryption way.
     *
     * @param $password
     * @param $savedPassword
     *
     * @return bool
     */
    protected function oldPasswordEncryptionCheck($password, $savedPassword)
    {

        $savedPasswordB64Decode = base64_decode($savedPassword);
        $salt = substr($savedPasswordB64Decode, 20);
        $passwordB64Encode = base64_encode(sha1(md5($password) . $salt, true) . $salt);

        if (strcmp($passwordB64Encode, $savedPassword) == 0)
            return true;
        else
            return false;
    }

}