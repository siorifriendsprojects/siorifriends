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
                    'is_publishing' => $faker->boolean,
                    'is_commentable' => $faker->boolean,
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
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
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
                    ],
                ],
            ],
            'failed without tag' => [
                false,
                [
                    'description' => $faker->sentence(),
                    'is_publishing' => $faker->boolean,
                    'is_commentable' => $faker->boolean,
                    'tags' => [],
                    'anchors' => [
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
                        ['url' => $faker->unique()->url, 'name' => $faker->name],
                    ],
                ]
            ],
            'failed without anchor' => [
                false,
                [
                    'description' => $faker->sentence(),
                    'is_publishing' => $faker->boolean,
                    'is_commentable' => $faker->boolean,
                    'tags' => [$faker->unique()->word, $faker->unique()->word],
                    'anchors' => [],
                ]
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
