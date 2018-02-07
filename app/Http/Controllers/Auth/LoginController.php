<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\SioriFriends\Models\User\User;
use Auth;
use Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/logined';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//Twitter
public function getTwitterAuth(){
  return Socialite::driver('twitter')->redirect();
}
    public function getTwitterAuthCallback() {
          try {
              $tuser = Socialite::driver('twitter')->user();
            }   catch (\Exception $e)
                  {
                    return redirect("/");
                  }

                  $authuser = $this->findOrCreateTuser($tuser);
                    Auth::login($authuser,true);
                    return redirect('/');
         }

    private function findOrCreateTuser($tuser){
          $authuser = User::where('account', $tuser->nickname)->first();
              if ($authuser){
                       return $authuser;
                   }
                 return User::create([  //ユーザー登録
                          'account' =>$tuser->nickname,
                           'name' => $tuser->name,
                           'email'=>str_random(20)."@example.com",     //仮置き
                           'password'=>bcrypt(str_random(20)),      //仮置き
                         ]);
       }


//Google
public function getGoogleAuth(){
    return Socialite::driver('google')->redirect();
}
  public function getGoogleAuthCallback() {
     try {
         $guser = Socialite::driver('google')->user();
       } catch (\Exception $e) {
         return redirect("/");
          }
     $authuser = $this->findOrCreateGuser($guser);
       Auth::login($authuser,true);
       return redirect('/');
}

private function findOrCreateGuser($guser){
$authuser = User::where('account', $guser->id)->first();
 if ($authuser){
          return $authuser;
      }
    return User::create([  //ユーザー登録
       'account' =>$guser->id,
       'name' => $guser->name,
       'email' => $guser->email,
       'password'=>bcrypt(str_random(20)),   //仮置き
            ]);
}

}
