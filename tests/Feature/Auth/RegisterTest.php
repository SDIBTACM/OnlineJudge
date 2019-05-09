<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-07 21:02
 */

namespace Tests\Feature\Auth;


use App\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * As user to reg a new account
     */
    public function testUserNotInDatabase()
    {
        $user = factory(User::class)->make();

        $this->from('/register')->post('/register', [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password2', // Password no equal
            'email' => $user->email,
            'school' => $user->school
        ])->assertRedirect('/register');

        $response = $this->from('/register')->post('/register', [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => $user->email,
            'school' => $user->school
        ]);

        $response->assertRedirect('/');

    }

    /**
     * the email have been in db, and have not be tag deleted
     */
    public function testUserEmailInDatabase()
    {
        $user = factory(User::class)->create();

        $response = $this->from('/register')->post('/register', [
            'username' => $user->username . "NEW_ONE",
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => $user->email,
            'school' => $user->school
        ]);
        $response->assertRedirect('/register');

    }

    /**
     * the username have been in db, and have not be tag deleted
     */
    public function testUserUsernameInDatabase()
    {
        $user = factory(User::class)->create();

        $response = $this->from('/register')->post('/register', [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => $user->email . "NEW_ONE",
            'school' => $user->school
        ]);

        $response->assertRedirect('/register');

    }

    /**
     * the email have been in db, and have be tag deleted
     */
    public function testUserEmailButDeletedInDatabase()
    {
        $user = factory(User::class)->create();
        $user->delete();

        $response = $this->from('/register')->post('/register', [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => $user->email,
            'school' => $user->school
        ]);

        $response->assertRedirect('/');

    }

    /**
     * the username have been in db, and have be tag deleted
     */
    public function testUserUsernameButDeletedInDatabase()
    {
        $user = factory(User::class)->create();
        $user->delete();

        $response = $this->withoutMiddleware()->from('/register')->post('/register', [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'password' => 'password',
            'password_confirmation' => 'password',
            'email' => $user->email,
            'school' => $user->school
        ]);

        $response->assertRedirect('/');

    }
}