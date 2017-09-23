<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FollowController extends Controller
{
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }

    /**
     * @param string $account
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showFollows(string $account)
    {
        try {
            $user = $this->users->findByAccount($account);
            return view('follow', [
                'users' => $user->followUsers,
            ]);
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }
    }

    public function showFollowers(string $account)
    {
        try {
            $user = $this->users->findByAccount($account);
            return view('follow', [
                'users' => $user->followers,
            ]);
        } catch (ModelNotFoundException $exception) {
            return $exception->getMessage();
        }
    }
}
