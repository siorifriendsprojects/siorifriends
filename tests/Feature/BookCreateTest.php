<?php

namespace Tests\Feature;

use App\SioriFriends\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookCreateTest extends TestCase
{
    use DatabaseTransactions;

    /** @var User */
    private $user;

    /** @var array */
    private $requestParameter;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = User::first();

        $this->requestParameter = [
            'title' => 'book title',
            'description' => 'この本の説明',
            'isPublishing' => true,
            'isCommentable' => false,
            'tags' => ['php', 'laravel'],
            'anchors' => [
                ['url' => 'http://qiita.com', 'name' => 'qiita'],
                ['url' => 'https://www.google.co.jp', 'name' => 'google'],
            ],
        ];
    }

    public function requestDataProvider()
    {
        return [
            'success' => [
                302, // 成功時はリダイレクトする
                [
                    'title' => 'book title',
                    'description' => 'この本の説明',
                    'isPublishing' => true,
                    'isCommentable' => false,
                    'tags' => ['php', 'laravel'],
                    'anchors' => [
                        ['url' => 'http://qiita.com', 'name' => 'qiita'],
                        ['url' => 'https://www.google.co.jp', 'name' => 'google'],
                    ]
                ]
            ],
            'failed : invalid arguments' => [
                302,
                [
                    'description' => 'この本の説明',
                    'isPublishing' => true,
                    'isCommentable' => false,
                    'tags' => ['php', 'laravel'],
                    'anchors' => [
                        ['url' => 'http://qiita.com', 'name' => 'qiita'],
                        ['url' => 'https://www.google.co.jp', 'name' => 'google'],
                    ]
                ]
            ],
            'failed : not login' => [
                403,
                [
                    'title' => 'book title',
                    'description' => 'この本の説明',
                    'isPublishing' => true,
                    'isCommentable' => false,
                    'tags' => ['php', 'laravel'],
                    'anchors' => [
                        ['url' => 'http://qiita.com', 'name' => 'qiita'],
                        ['url' => 'https://www.google.co.jp', 'name' => 'google'],
                    ]
                ],
                false, // test でlogin をしないフラグ
            ],
        ];
    }

    /**
     * @dataProvider requestDataProvider
     */
    public function testPost($statusCode, $request, $isToLogin = true)
    {
        if ($isToLogin) Auth::login($this->user);
        $response = $this->post('/books', $request);

        $response->assertStatus($statusCode);
    }
}
