<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    /**
     *
     *
    public function testCreate()
    {
        $user = \App\SioriFriends\Models\User\User::firstOrCreate(['account' => 'test','name' => 'test', 'email' => 'test@test.jp','password' => 'test']);

        $response = $this->actingAs($user)->call('POST','/books/new',['book' =>
        '
        {
            title: "title",
            description: "description",
            tags: ["tag"],
            anchors: [
                { url: "http://localhost", name: "name" },
                { url: "http://localhost/ttt", name: "namename" },
            ],
        }
        ',
        '_token' => csrf_token()]);

        $this->assertEquals("",$response->content());

    }
    */
}
