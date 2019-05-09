<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $tokenCheck = 'reset-password-token:' . $token;

        if (!Cache::has($tokenCheck)) {
            Log::warning('Ip: {} try to hack us', $request->ip());
            abort(410, 'The link has expired.');
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => Cache::get($tokenCheck)]
        );
    }

    /**
     * Reset the given user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {

        $this->validateData($request);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
//        $response = $this->broker()->reset(
//            $this->credentials($request), function ($user, $password) {
//            $this->resetPassword($user, $password);
//            }
//        );

        $response = $this->checkAndResetPassword($request);

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($request, $response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * Validate the request for the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateData(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required | confirmed | min:7'
        ]);

    }

    /**
     * @param Request $request
     * @return string|bool
     */
    protected function checkAndResetPassword(Request $request)
    {

        $token = 'reset-password-token:' . $request->input('token');

        if (!Cache::has($token)) {
            Log::warning('Ip: {} try to hack us', $request->ip());
            abort(410, 'The link has expired.');
        }

        if (Cache::get($token) != $request->input('email')) {
            Log::warning('Some one get the token which is in the cache!');
            abort(403);
        }

        $email = Cache::get($token);
        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            Log::warning('The User is not exists! ip: {}, email: {}', $request->ip(), $email);
            abort(404);
        }

        $this->resetPassword($user, $request->input('password'));

        return Password::PASSWORD_RESET;
    }

    /**
     * Reset password
     * @param User $user
     * @param $password
     */
    protected function resetPassword(User $user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
