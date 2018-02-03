<?php

namespace App\Http\Controllers\User;

use App\SioriFriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


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

    public function update(Request $request){

        Auth::user()->profile->birthday = $request['birthday'];
        Auth::user()->profile->gender = $request['gender'];
        Auth::user()->profile->intro = $request['intro'];

        if ($request->file('icon') != null && $request->file('icon')->isValid()) {
            $fileName = $request->file('icon')->move(public_path().'/img/icons',Auth::id().".".$request->file('icon')->getClientOriginalExtension());
            Auth::user()->profile->icon_path = "/img/icons/".Auth::id().".".$request->file('icon')->getClientOriginalExtension();
        }
        Auth::user()->profile->save();

        Auth::user()->name = $request['name'];
        Auth::user()->save();

        return redirect(route('overview',['account' => Auth::user()->account]));
    }
}
