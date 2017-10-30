<?php

namespace Tests\Unit;

use App\Http\Requests\StoreBookPost;
use App\SioriFriends\Models\Book\BookFactory;
use App\SioriFriends\Models\Book\BookSpec;
use App\SioriFriends\Models\User\User;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookFactoryTest extends TestCase
{
//    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @var User */
    private $user;
    /** @var Request */
    private $request;
    /** @var BookSpec */
    private $bookSpec;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->user = User::first();
        $this->request = new StoreBookPost([
            'title' => 'test title',
            'description' => 'test description',
            'isPublishing' => true,
            'isCommentable' => false,
            'tags' => ['test', 'php'],
            'anchors' => [
                ['url' => 'http://qiita.com', 'name' => 'qiita'],
            ],
        ]);
        $this->bookSpec = new BookSpec($this->user, $this->request);
    }

    public function testCreate()
    {
        // test target.
        $book = BookFactory::create($this->bookSpec);

        // 本が作成されたか。
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);

        collect($this->bookSpec->anchors())->each(function($hash) {
            $this->assertDatabaseHas('anchor_book', [
                'name' => $hash['name'],
            ]);
        });

        $this->assertDatabaseHas('book_tag', [
            'book_id' => $book->id,
        ]);
    }
}
