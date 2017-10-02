<?php

namespace Tests\Unit;

use App\SioriFriends\Models\User\Profile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentProfileTest extends TestCase
{
    //    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @var Profile */
    private $target;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->target = factory(Profile::class)->create();
    }


    public function testUser()
    {
        $user = $this->target->user;

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }
}