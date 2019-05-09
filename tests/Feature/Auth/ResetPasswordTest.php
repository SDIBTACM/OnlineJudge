<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-07 21:03
 */

namespace Tests\Feature\Auth;


use App\Log;
use App\Mails\ResetPasswordMail;
use App\Models\User;
use App\User as AuthUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testResetPassword()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $this->from('/password/reset')->post('/password/email', [
            'email' => $user->email,
        ]);

        $this->from('/password/reset')->post('/password/email', [
            'email' => $user->email,
        ]);

        Mail::assertSent(ResetPasswordMail::class, 2);

        $token = "";

        Mail::assertSent(ResetPasswordMail::class, function ($mail) use ($user, &$token) {
            $token = $mail->getToken();
            return $mail->hasTo($user->email);
        });

        $url = '/password/reset/' . $token;

        $this->from($url)->post('/password/reset',[
            'email' => $user->email,
            'password' => 'password2',
            'password_confirmation' => 'password1',
            'token' => $token
        ])->assertRedirect($url);

        $this->from($url)->post('/password/reset',[
            'email' => $user->email,
            'password' => 'password2',
            'password_confirmation' => 'password2',
            'token' => $token
        ])->assertRedirect('/');


        // use new password to login
        $this->from('/login')->post('/login', [
            'identification' => $user->username,
            'password' => 'password2'
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs(AuthUser::find($user->id));
    }
}