<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use App\Models\LoginLog;
use App\Models\Option;
use App\Units\Tools\Ip;
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
            Log::warning('user: {} ip: {} login fail too much', $request->input($this->username()), $request->ips());
            return $this->sendLockoutResponse($request);
        }

        $credentialRequest = $this->credentials($request);
        $credentialRequestWithoutPassword = $credentialRequest;
        unset($credentialRequestWithoutPassword['password']);

        $user = User::where($credentialRequestWithoutPassword)->first();

        if ( !is_null($user) ) {

            if ($user->role != 'admin' && $user->role != 'teacher') {
                $this->allowLoginFromIp($request);
                $this->allowLoginFromDifferentIp($request->ip(), $user->id);
            }

            if ($this->attemptLogin($request, $credentialRequest) || $this->attemptLoginByOldPasswordEncryption($request, $credentialRequest)) {

                $this->addLoginLog($request, $user->id);
                Log::info('user: {} login success', $user->username);
                return $this->sendLoginResponse($request);
            }

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
     * @param Array $credentialRequest
     * @return bool
     */
    protected function attemptLogin(Request $request, $credentialRequest)
    {
        return $this->guard()->attempt(
            $credentialRequest, $request->filled('remember')
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
            $credentials = array_merge($credentials, ['username' => $request->input($this->username())]);
        } else {
            $credentials = array_merge($credentials, ['email' => $request->input($this->username())]);
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
     * @param Array $credentialRequest
     * @return bool
     */
    protected function attemptLoginByOldPasswordEncryption(Request $request, $credentialRequest)
    {

        $userInputPassword = $credentialRequest['password'];
        unset($credentialRequest['password']);

        $user = User::where($credentialRequest)->first();



        if ($this->oldPasswordEncryptionCheck($userInputPassword, $user->password) === false) {
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

        if (strcmp($passwordB64Encode, $savedPassword) == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check ip is allow to login
     * @param Request $request
     * @return bool|void
     */
    protected function allowLoginFromIp(Request $request) {

        $denyVisitIps = json_decode(Option::getOption('deny_login_ips'), true);
        $allowVisitIps = json_decode(Option::getOption('allow_login_ips'), true);

        Log::debug('deny login ip limit count: {}', count($denyVisitIps));
        Log::debug('allow login ip limit count: {}', count($allowVisitIps));

        if (count($denyVisitIps) && Ip::isIpInSubnets($request->ip(), $denyVisitIps)) {
            Log::info('user mail/username: {}, try to login from: {} but fail.', $request->input($this->username()), $request->ips());
            abort(403, 'Your ip not allow to login');
        }

        if (count($allowVisitIps) && (! Ip::isIpInSubnets($request->ip(), $allowVisitIps))) {
            Log::info('user mail/username: {}, try to login from: {} but fail.', $request->input($this->username()), $request->ips());
            abort(403, 'Your ip not allow to login');
        }

    }

    /**
     * Check user is login twice from different client/browser
     * @param $ip
     * @param $userId
     */

    protected function allowLoginFromDifferentIp($ip, $userId) {
        $sysStatus = json_decode(Option::getOption('system_status'), true);

        switch ($sysStatus['status']) {
            case 0: {
                break;
            }
            case 1: {
                $sameUserLoginCount = LoginLog::where('ip', '<>', $ip)->where('created_at', '>', $sysStatus['start_time'])
                    ->where('user_id', $userId)->count();
                $sameIpLoginCount = LoginLog::where('ip', $ip)->where('created_at', '>', $sysStatus['start_time'])
                    ->where('user_id', '<>' ,$userId)->count();
                if ($sameIpLoginCount) {
                    Log::info('user: {} login from {}, but the ip have been login by other user', User::find($userId)->pluck('username'), $ip);
                    abort(403, 'Please do not login from other client.');
                }
                if ($sameUserLoginCount) {
                    Log::info('user: {} login from {}, but the user have been login from other ip', User::find($userId)->pluck('username'), $ip);
                    abort(403, 'Please do not login from other client.');
                }
                break;
            }
        }
    }

    /**
     * Add login log.
     * @param Request $request
     * @param $userId
     */
    protected function addLoginLog(Request $request, $userId) {
        $loginLog = new LoginLog;

        $loginLog->user_id = $userId;
        $loginLog->ip = $request->ip();
        $loginLog->save();
    }

}