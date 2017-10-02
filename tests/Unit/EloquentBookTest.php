<?php

namespace Tests\Unit;

use App\SioriFriends\Models\Book\Anchor;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Comment;
use App\SioriFriends\Models\Book\Tag;
use App\SioriFriends\Models\User\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EloquentBookTest extends TestCase
{
    //    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @var Book */
    private $target;

    /** @var Anchor */
    private $anchor;

    /** @var Tag */
    private $tag;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->target = factory(Book::class)->create();
        $this->anchor = factory(Anchor::class)->create();
        $this->tag = factory(Tag::class)->create();
    }

    public function testAddAnchor()
    {
        $this->target->addAnchor($this->anchor);

        $this->assertDatabaseHas('anchor_book', [
            'anchor_id' => $this->anchor->id,
            'book_id' => $this->target->id,
        ]);
    }

    public function testRemoveAnchor()
    {
        $this->testAddAnchor();
        $this->target->removeAnchor($this->anchor);

        $this->assertDatabaseMissing('anchor_book', [
            'anchor_id' => $this->anchor->id,
            'book_id' => $this->target->id,
        ]);
    }

    public function testAddTag()
    {
        $this->target->addTag($this->tag);

        $this->assertDatabaseHas('book_tag', [
            'book_id' => $this->target->id,
            'tag_id' => $this->tag->id,
        ]);
    }

    public function testRemoveTag()
    {
        $this->testAddTag();
        $this->target->removeTag($this->tag);

        $this->assertDatabaseMissing('book_tag', [
            'book_id' => $this->target->id,
            'tag_id' => $this->tag->id,
        ]);
    }

    public function testAddComment()
    {
        \Faker\Provider\ja_JP\Text::class;
        $comment = \Faker\Factory::create('ja_JP')->text();
        $user = factory(User::class)->create();

        $this->target->addComment($user, $comment);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'book_id' => $this->target->id,
            'body' => $comment,
        ]);
    }

    public function testAuthor()
    {
        $author = $this->target->author;
        $this->assertNotNull($author);
    }
}