<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-06 19:49
 */

namespace App\Mails;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * User
     * Token
     */
    protected $user;
    protected $token;

    /**
     * const
     * @param User $user
     * @param String $token
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Build Message
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->username)
            ->subject(__('Reset Password Notification'))
            ->markdown('emails.user.reset_password')
            ->with([
                'user' => $this->user,
                'token' => $this->token,
            ]);
    }

    /**
     * Get Token
     * @return mixed
     */
    public function getToken() {
        return $this->token;
    }
}