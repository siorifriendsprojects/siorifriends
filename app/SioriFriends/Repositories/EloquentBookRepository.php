<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/02
 * Time: 14:23
 */

namespace App\SioriFriends\Repositories;


use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\BookRepository;
use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentBookRepository implements BookRepository
{
    /** @var UserRepository */
    private $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * 本を追加する。
     *
     * @param Model $book
     */
    public function add(Book $book)
    {
        $book->save();
    }

    /**
     * 本の一覧を返す。
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return Book::all();
    }

    /**
     * id で本を取得する。
     *
     * @param string $bookId
     * @return mixed
     * @throws ModelNotFoundException 本が見つからなかった場合。
     */
    public function findById(string $bookId)
    {
        return Book::findOrFail($bookId);
    }

    /**
     * ユーザのアカウント名からそのユーザの本の一覧を取得する。
     *
     * @param string $account
     * @return mixed
     * @throws ModelNotFoundException ユーザが見つからなかった場合。
     */
    public function findByUserAccount(string $account)
    {
        $user = $this->users->findByAccount($account);
        return $user->books;
    }

    /**
     * ユーザのアカウント名からそのユーザがお気に入りに登録している本の一覧を取得する。
     *
     * @param string $account
     * @return mixed
     * @throws ModelNotFoundException ユーザが見つからなかった場合。
     */
    public function findFavoritesByUserAccount(string $account)
    {
        $user = $this->users->findByAccount($account);
        return $user->favorites;
    }

    /**
     *
     * 新着の本を limit 件取得する。
     *
     * @param int $limit 取得する本の数
     * @return \Illuminate\Database\Eloquent\Builder 取得した本
     *
     */
    public function fetchNewBooks(int $limit)
    {
        return Book::orderBy('created_at','desc')->take($limit);
    }

    /**
     * 本の変更を保存する。
     *
     * @param Model $book
     */
    public function save(Book $book)
    {
        $book->save();
    }

    /**
     * 本を削除する.
     *
     * @param Model $book
     */
    public function remove(Book $book)
    {
        $book->delete();
    }

    public function wordSearch($word,$orderBy,$page){
        $bookQuery = Book::where('title', 'like', "%{$word}%")->orWhere('description', 'like', "%{$word}%");

        $bookQuery = $this->searchResultSort($bookQuery,$orderBy);

        $tmpBooks = $bookQuery->paginate(10);

        $tmpBooks->appends(['word' => $word, 'orderby' => $orderBy]);

        $books = [];

        foreach($tmpBooks as $book){
            $books[] = $book;
        }

        return view("books.search",[
                "books" => $books,
                "nextLink" => $tmpBooks->nextPageUrl(),
                "prevLink" => $tmpBooks->previousPageUrl(),
                "isFirst" => ($page <= 1),
                "isLast" => $tmpBooks->hasMorePages() == false,
                "tagSearch" => false,
                "orderby" => $orderBy,
                "key" => $word
        ]);
    }

    public function tagSearch($tag,$orderBy,$page){
        $bookQuery = Book::WhereHas('tags', function ($query) use ($tag) {
            $query->Where('name', $tag);
        });

        $bookQuery = $this->searchResultSort($bookQuery,$orderBy);

        $tmpBooks = $bookQuery->paginate(10);

        $tmpBooks->appends(['tag' => $tag, 'orderby' => $orderBy]);

        $books = [];

        foreach($tmpBooks as $book){
            $books[] = $book;
        }

        return view("books.search",[
            "books" => $books,
            "nextLink" => $tmpBooks->nextPageUrl(),
            "prevLink" => $tmpBooks->previousPageUrl(),
            "isFirst" => ($page <= 1),
            "isLast" => $tmpBooks->hasMorePages() == false,
            "tagSearch" => true,
            "orderby" => $orderBy,
            "key" => $tag
        ]);
    }

    private function searchResultSort($bookQuery,$orderBy){
        $sortedBooks = null;
        switch($orderBy){
            case "update_asc":
                $sortedBooks = $bookQuery->orderBy("updated_at","asc");
                break;
            case "update_desc":
                $sortedBooks = $bookQuery->orderBy("updated_at","desc");
                break;
            /* TODO: ここの並び順の実装はまだです
            case "comment_asc":
                break;
            case "comment_desc":
                break;
            case "hot_asc":
                break;
            case "hot_desc":
                break;*/
            case "create_asc":
                $sortedBooks = $bookQuery->orderBy("created_at","asc");
                break;
            default://case "create_desc":
                $sortedBooks = $bookQuery->orderBy("created_at","desc");
                break;
        }
        return $sortedBooks;
    }
}
