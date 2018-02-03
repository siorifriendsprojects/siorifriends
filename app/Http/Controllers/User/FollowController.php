<?php

namespace App\Http\Controllers\User;

use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Models\User\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowController extends Controller
{
    /** @var UserRepository */
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }


    /**
     * follow user の一覧を表示する。
     *
     * @param string $account ユーザのアカウント
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(string $account)
    {
        try {
            $user = $this->users->findByAccount($account);

            return view('user.follow', [
                'users' => $user->follows
            ]);
        } catch (ModelNotFoundException $exception) {
            abort(404, 'User not found.');
        }
    }
}
