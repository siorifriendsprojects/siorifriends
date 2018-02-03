<?php

namespace App\Http\Controllers\User;

use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    /** @var UserRepository */
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }

    public function __invoke(string $account)
    {
        try {
            $user = $this->users->findByAccount($account);

            return view('user.follow', [
                'users' => $user->followers
            ]);
        } catch (ModelNotFoundException $e) {
            abort(404, 'User not found.');
        }
    }
}