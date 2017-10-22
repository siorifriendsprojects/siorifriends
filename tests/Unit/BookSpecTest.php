<?php

namespace Tests\Unit;

use App\SioriFriends\Models\Book\BookSpec;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookSpecTest extends TestCase
{
    //    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * @return array
     */
    public function rulesDataProvider()
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'success pattern' => [
                true,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'isPublishing' => $faker->boolean,
                    'isCommentable' => $faker->boolean,
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                    ],
                ],
            ],
            'success without boolean field' => [
                true,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                    ],
                ],
            ],
            'failed without tag' => [
                false,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'isPublishing' => $faker->boolean,
                    'isCommentable' => $faker->boolean,
                    'tags' => [],
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                    ],
                ]
            ],
            'failed without anchor' => [
                false,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'isPublishing' => $faker->boolean,
                    'isCommentable' => $faker->boolean,
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [],
                ]
            ],
            'failed over tags' => [
                false,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'isPublishing' => $faker->boolean,
                    'isCommentable' => $faker->boolean,
                    'tags' => collect(range(1, 11))
                        ->map(function($__) use ($faker) { return $faker->word; })
                        ->toArray(),
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->sentence(3)],
                    ],
                ],
            ],
            'failed over anchor' => [
                false,
                [
                    'title' => $faker->jobTitle,
                    'description' => $faker->sentence(),
                    'isPublishing' => $faker->boolean,
                    'isCommentable' => $faker->boolean,
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [
                        collect(range(1, 31))->map(function($_) use ($faker) {
                            return [
                                'url' => $faker->unique()->url,
                                'name' => $faker->sentence(3)
                            ];
                        })->toArray(),
                    ],
                ],
            ],
        ];
    }


    /**
     * @param bool $expected 期待値
     * @param array $parameters テストデータ
     * @dataProvider rulesDataProvider
     */
    public function testRules(bool $expected, array $parameters)
    {
        $rule = BookSpec::rules();
        $validator = Validator::make($parameters, $rule);
        $actual = $validator->passes();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param bool $expected
     * @param array $parameters
     * @dataProvider rulesDataProvider
     */
    public function testConstruct(bool $expected, array $parameters)
    {
        try {
            new BookSpec($parameters);
            $this->assertEquals($expected, true);
        } catch (\InvalidArgumentException $e) {
            $this->assertEquals($expected, false);
        }
    }
}
