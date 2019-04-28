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

    public function testAll() {

        $userIds = $this->add(5);

        $userArray = [];

        foreach ($userIds as $userId) {
            $userArray[$userId] = User::find($userId)->toArray();
            unset($userArray[$userId]['created_at']);
            unset($userArray[$userId]['updated_at']);
            unset($userArray[$userId]['email_verified_at']);
            unset($userArray[$userId]['deleted_at']);
        }

        $this->hardDelete($userIds[2]);
        $this->assertDatabaseMissing('users', $userArray[$userIds[2]]);

        $this->softDelete($userIds[3]);
        $this->assertSoftDeleted('users', $userArray[$userIds[3]]);

        $this->assertSame(4, User::withTrashed()->where('nickname', "TS")->count());
        $this->assertSame(1, User::onlyTrashed()->where('nickname', "TS")->count());
        $this->assertSame(3, User::where('nickname', "TS")->count());

        $this->restoreSoftDelete($userIds[3]);
        $this->assertDatabaseHas('users', $userArray[$userIds[3]]);
        $this->assertSame(4, User::withTrashed()->where('nickname', "TS")->count());
        $this->assertSame(0, User::onlyTrashed()->where('nickname', "TS")->count());
        $this->assertSame(4, User::where('nickname', "TS")->count());

        foreach ($userIds as $userId) {
            $this->hardDelete($userId);
        }

    }

    private function add($count) {

        $userIds = [];
        for ($i = 0; $i < $count; $i++) {
            $user = new User;
            $user->username = "__TEST$i";
            $user->password = "__TEST$i";
            $user->nickname = "TS";
            $user->email = "__TEST$i@TEST.TEST";
            $user->save();

            $this->assertDatabaseHas('users', $user->toArray());
            array_push($userIds, $user->id);
        }

        return $userIds;
    }

    private function softDelete($userId) {
        $user = User::find($userId);
        try {
            $user->delete();
        } catch (\Exception $e) {
            $this->assertFalse(false, $e->getMessage());
        }
    }

    private function hardDelete($userId) {
        $user = User::find($userId);
        $user->forceDelete();
    }

    private function restoreSoftDelete($userId) {
        $user = User::withTrashed()->find($userId);
        $user->restore();
    }
}