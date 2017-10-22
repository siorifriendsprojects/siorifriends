<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/10/16
 * Time: 15:29
 */

namespace App\SioriFriends\Models\Book;


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
            'isPublishing' => 'sometimes|required|boolean',
            'isCommentable' => 'sometimes|required|boolean',
            'tags' => 'required|array',
            'tags.*' => 'required|string|min:1|max:10',
            'anchors' => 'required|array',
            'anchors.*' => 'min:1|max:30',
            'anchors.*.url' => 'required|url',
            'anchors.*.name' => 'required|string'
        ];
    }

    /**
     * BookSpec constructor.
     *
     * 連想配列を受け取って本を作成可能ならインスタンスを返す。
     * 作成そうでない場合は、InvalidArgumentExceptionを投げる
     *
     * @param array $parameters 本を作成するのに必要な値の連想配列
     * @throws \InvalidArgumentException 引数をバリデーションして失敗した場合
     */
    public function __construct(array $parameters)
    {
        $validator = Validator::make($parameters, self::rules());
        if ($validator->fails()) {
            throw new \InvalidArgumentException("Failed parameters validation.");
        }

        $this->title = $parameters['title'];
        $this->description = $parameters['description'];
        $this->isPublishing = $parameters['isPublishing'] ?? true;  // default value true
        $this->isCommentable = $parameters['isCommentable'] ?? true;
        $this->tags = $parameters['tags'];
        $this->anchors = $parameters['anchors'];
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
