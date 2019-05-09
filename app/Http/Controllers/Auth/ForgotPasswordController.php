<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Log;
use App\Mails\ResetPasswordMail;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Psr\SimpleCache\InvalidArgumentException;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {

        Log::info('user who with email: {} request to reset password', $request->input('email'));


        $this->validateEmail($request);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.

        $response = $this->sentMail($request->only('email'));


        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    /**
     * Get token and sent mail
     * @param string $email
     * @return string|bool
     */
    protected function sentMail($email)
    {

        $user = User::where('email', $email)->first();
        $token = $this->getToken($user);

        $mail = new ResetPasswordMail($user, $token);
        $mail = $mail->build();

        Mail::send($mail);
        if (Mail::failures()) {
            Log::error('', Mail::failures());
            return false;
        }

        return Password::RESET_LINK_SENT;
    }

    /**
     * Validate the email for the given request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::exists('users')->where(function ($query) use ($request) {
                    $query->where('deleted_at', 0);
                }),
            ]
        ]);

    }

    /**
     * Get Token
     *
     * @param User $user
     * @return string
     */

    protected function getToken(User $user)
    {
        $string = $user->username . $user->email;
        $string = Hash::make($string);
        $string = sha1($string);

        try {
            Cache::set('reset-password-token:' . $string, $user->email, config('auth.passwords.users.expire') * 60);
        } catch (InvalidArgumentException $e) {
            Log::error('Cache Failed! err: {}', $e->getMessage());
            abort(500, $e->getMessage());
        }

        return $string;
    }
}
