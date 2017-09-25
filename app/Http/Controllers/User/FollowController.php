<?php

namespace App\Http\Controllers\User;

use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowController extends Controller
{
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }


    /**
     * follow page を返すメソッド。
     *
     * @param string $account ユーザのアカウント
     * @param callable $func viewに渡すパラメータを返すcallback関数。
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function showUsers(string $account, callable $func)
    {
        try {
            $user = $this->users->findByAccount($account);
            return view('user.follow', $func($user));

        } catch (ModelNotFoundException $exception) {
            abort(404, 'User not found.');
        }
    }


    /**
     * @param string $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFollows(string $account)
    {
        return $this->showUsers($account, function(User $user) {
            // follow.blade に渡すパラメータ
            return [
                'users' => $user->follows
            ];
        });
    }

    /**
     * @param string $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showFollowers(string $account)
    {
        return $this->showUsers($account, function(User $user) {
            // follow.blade に渡すパラメータ
            return [
                'users' => $user->followers
            ];
        });
    }
}
