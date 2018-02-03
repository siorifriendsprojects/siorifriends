<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/17
 * Time: 0:07
 */

namespace App\SioriFriends\Models\User;


class UserFactory
{

    /**
     * @param string $account
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public static function createUser(string $account, string $name, string $email, string $password)
    {
        $user = new User;
        $user->account  = $account;
        $user->name     = $name;
        $user->email    = $email;
        $user->password = bcrypt($password);
        $user->save();

        return $user;
    }
}
