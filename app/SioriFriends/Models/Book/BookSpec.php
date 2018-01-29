<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/16
 * Time: 15:29
 */

namespace App\SioriFriends\Models\Book;


use App\SioriFriends\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class BookSpec
 *
 * Book の仕様を定めたクラス。
 *
 * @package App\SioriFriends\Models\Book
 */
class BookSpec
{
    /** @var string */
    private $title;
    /** @var string */
    private $description;
    /** @var bool */
    private $isPublishing;
    /** @var bool */
    private $isCommentable;
    /** @var array */
    private $tags;
    /** @var array */
    private $anchors;

    /**
     * 本の作成に必要なパラメータのバリデーションルール
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'is_publishing' => 'required|string',
            'is_commentable' => 'required|string',
            'tags' => 'required|array|min:1|max:10',
            'tags.*' => 'required|string',
            'anchors' => 'required|array|min:1|max:30',
            'anchors.*' => 'required|array',
            'anchors.*.url' => 'required|url',
            'anchors.*.name' => 'required|string'
        ];
    }

    /**
     * BookSpec constructor.
     *
     * validationはcontroller がrequest を受け取るときに行う。
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->title = $request->input('title');
        $this->description = $request->input('description');
        $this->isPublishing = $request->input('is_publishing') === 'true';
        $this->isCommentable = $request->input('is_commentable') === 'true';
        $this->tags = $request->input('tags');
        $this->anchors = $request->input('anchors');
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function isPublishing()
    {
        return $this->isPublishing;
    }

    public function isCommentable()
    {
        return $this->isCommentable;
    }

    public function tags()
    {
        return $this->tags;
    }

    public function anchors()
    {
        return $this->anchors;
    }
}
