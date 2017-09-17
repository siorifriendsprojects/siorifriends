<?php

namespace Tests\Unit;

use App\Siorifriends\Models\User\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentUserTest extends TestCase
{
//    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @var User
     */
    private $target;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->target = factory(User::class)->create();
    }

    /**
     * ユーザをフォローできるか
     */
    public function testFollowFor()
    {
        $followingUser = factory(User::class)->create();
        $this->target->followFor($followingUser->id);

        $this->assertDatabaseHas('follows', [
            'user_id' => $this->target->id,
            'follow_id' => $followingUser->id,
        ]);
    }

    public function testUnFollowFor()
    {
        $followingUser = factory(User::class)->create();
        $this->target->followFor($followingUser->id);

        $this->target->unFollowFor($followingUser->id);

        $this->assertDatabaseMissing('follows', [
            'user_id' => $this->target->id,
            'follow_id' => $followingUser->id,
        ]);
    }
}
