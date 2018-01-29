<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookPost;
use App\SioriFriends\Models\Book\Book;
use App\SioriFriends\Models\Book\Tag;
use App\SioriFriends\Models\Book\Anchor;
use App\SioriFriends\Models\Book\BookFactory;
use App\SioriFriends\Models\Book\BookRepository;
use App\SioriFriends\Models\Book\BookSpec;
use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookController extends Controller
{
    /** @var UserRepository */
    private $users;

    /** @var BookRepository */
    private $books;

    public function __construct(UserRepository $userRepository, BookRepository $bookRepository)
    {
        $this->users = $userRepository;
        $this->books = $bookRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.editor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookPost $request)
    {
        try {
            // request が本の仕様を満たしているかどうか
            $bookSpec = new BookSpec($request);
            // login user model の取得
            $author = $this->users->findById(Auth::id());
            $book = BookFactory::create($author, $bookSpec);

            //作成した本のページヘリダイレクトする
            $to = route('books.show', [ 'bookId' => $book->id ]);
            return redirect($to);
        } catch (ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string $bookId
     * @return \Illuminate\Http\Response
     */
    public function show($bookId)
    {
        try {
            $book = $this->books->findById($bookId);
            // ログインしている、かつ、本の作者
            $isMyBook = Auth::check() && $book->author->id === Auth::id();

            return view('books.show', [
                'book' => $book,
                'isMyBook' => $isMyBook
            ]);
        } catch(ModelNotFoundException $e) {
//            throwException($e::class);
            abort(404, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $bookId
     * @return \Illuminate\Http\Response
     */
    public function edit($bookId)
    {
        try {
            $book = $this->books->findById($bookId);
            // ログインしている、かつ、本の作者
            $isMyBook = Auth::check() && $book->author->id === Auth::id();
            if (!$isMyBook) {
                return $this->show($bookId);
            }

            return view('books.editor', [
                'book' => $book,
            ]);
        } catch(ModelNotFoundException $e) {
//            throwException($e::class);
            abort(404, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookPost  $request
     * @param string $bookId
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookPost $request, string $bookId)
    {
        try {

            // ログインしている、かつ、本の作者
            $book = $this->books->findById($bookId);
            $isMyBook = Auth::check() && $book->author->id === Auth::id();
            if ($isMyBook) {
                //更新処理
                $spec = new BookSpec($request);
                $book->title = $spec->title();
                $book->description = $spec->description();
                $book->is_publishing = $spec->isPublishing();
                $book->is_commentable = $spec->isCommentable();

                // remove tag
                foreach($book->tags as $tag) {
                    $book->removeTag($tag);
                }

                $now = Carbon::now();
                foreach($spec->tags() as $tagName) {
                    $tag = Tag::firstOrCreate([
                        'name' => $tagName,
                        Tag::CREATED_AT => $now,
                    ]);
                    $book->addTag($tag);
                }

                // remove anchor
                foreach($book->anchors as $anchor) {
                    $book->removeAnchor($anchor);
                }
                // anchor の追加
                foreach ($spec->anchors() as $hash) {
                    $anchor = Anchor::firstOrCreate( ['url' => $hash['url'] ]);
                    $book->addAnchor($anchor, $hash['name']);
                }
                $book->save();
            }

            //本のページヘリダイレクトする
            $to = route('books.show', [ 'bookId' => $bookId ]);
            return redirect($to);
        } catch(ModelNotFoundException $e) {
            abort(404, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $bookId
     * @return \Illuminate\Http\Response
     */
    public function destroy($bookId)
    {
        try {
            $book = $this->books->findById($bookId);
            $author = $book->author;

            // ゲストユーザの場合、または、本の作者ではない場合はエラー
            if (Auth::guest() || $author->id !== Auth::id()) {
                abort(403, 'You do not have access authority.');
            }

            $this->books->remove($book);

            // ユーザの本の一覧へリダイレクト
            $to = route('bookshelf', [ 'account' => $author->account ]);
            return redirect($to);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Not found this resource.');
        }
    }

    public function search(Request $request){
        $orderBy = isset($request->orderby) ? $request->orderby : "create_desc";
        $page = isset($request->page) ? $request->page : 1;

        if(isset($request->word)){
            return $this->books->wordSearch($request->word,$orderBy,$page);
        }else if(isset($request->tag)){
            return $this->books->tagSearch($request->tag,$orderBy,$page);
        }
        return $this->books->wordSearch("",$orderBy,$page);
    }


    public function addComment(Request $request, string $bookId){
        $this->books->findById($bookId)->addComment(Auth::user(),$request["body"]);
        
        return redirect(route("books.show",$bookId));
    }
}
