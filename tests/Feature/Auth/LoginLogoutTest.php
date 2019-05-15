<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-05-09 11:23
 */

namespace Tests\Feature\Auth;


use App\Models\User;
use App\User as AuthUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginLogoutTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Login by Username
     */
    public function testLoginByUsername()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', $user->toArray());

        $this->from('/login')->post('/login', [
            'identification' => $user->username,
            'password' => 'error_password'
        ])->assertRedirect('/login');

        $this->from('/login')->post('/login', [
            'identification' => $user->username,
            'password' => 'password'
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs(AuthUser::find($user->id));
        $this->assertDatabaseHas('login_logs', ['user_id' => $user->id]);
    }

    /**
     * Login by Email
     */
    public function testLoginByEmail()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', $user->toArray());

        $this->from('/login')->post('/login', [
            'identification' => $user->email,
            'password' => 'error_password'
        ])->assertRedirect('/login');

        $this->from('/login')->post('/login', [
            'identification' => $user->email,
            'password' => 'password'
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs(AuthUser::find($user->id));
        $this->assertDatabaseHas('login_logs', ['user_id' => $user->id]);
    }

    /**
     * Logout by get Method
     */
    public function testLogoutByGet()
    {
        $user = factory(User::class)->create();
        $authUser = AuthUser::find($user->id);

        $this->actingAs($authUser);
        $this->assertAuthenticated();

        $this->get('/logout');
        $this->assertGuest();
    }

    /**
     * Logout by post Method
     */
    public function testLogoutByPost()
    {
        $user = factory(User::class)->create();
        $authUser = AuthUser::find($user->id);

        $this->actingAs($authUser);
        $this->assertAuthenticated();

        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();
    }
}