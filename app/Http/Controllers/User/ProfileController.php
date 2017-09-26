<?php

namespace App\Http\Controllers\User;

use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }

    public function show(string $account)
    {
        try {
            $user = $this->users->findByAccount($account);

            return view('user.profile', [
                'user' => $user,
            ]);
        } catch(ModelNotFoundException $e) {
            abort(404, 'User not found.');
        }
    }
}
