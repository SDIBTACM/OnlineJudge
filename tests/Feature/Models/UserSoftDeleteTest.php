<?php
/**
 * It have many bugs
 * Created in dreaming.
 * User: Boxjan
 * Datetime: 2019-04-27 15:22
 */

namespace Tests\Feature\Models;

use App\Models\User;


class UserSoftDeleteTest extends ModelTestCase
{

    public function testAll()
    {
        $users = factory(User::class, 5)->create();

        $userIds = [];
        foreach ($users as $user) {
            array_push($userIds, $user->id);
        }

        $willBeHardDeletedUser = User::find($userIds[0]);
        if (!is_null($willBeHardDeletedUser)) {
            $willBeHardDeletedUser->forceDelete();
        }
        $this->assertDatabaseMissing('users', $users->toArray()[0]);

        $willBeSoftDeletedUser = User::find($userIds[1]);
        try {
            $willBeSoftDeletedUser->delete();
        } catch (Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }
        $this->assertSoftDeleted('users', $users->toArray()[1]);

        $this->assertSame(4, User::withTrashed()->count());
        $this->assertSame(1, User::onlyTrashed()->count());
        $this->assertSame(3, User::count());

        $willBeSoftDeletedUser->restore();
        $this->assertDatabaseHas('users', $users->toArray()[1]);

        $this->assertSame(4, User::withTrashed()->count());
        $this->assertSame(0, User::onlyTrashed()->count());
        $this->assertSame(4, User::count());
    }
}