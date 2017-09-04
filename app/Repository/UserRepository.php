<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/04
 * Time: 10:55
 */

namespace App\Repository;

use App\User;

class UserRepository implements UserRepositoryInterface
{

    public function findAll()
    {
        return User::all();
    }

    public function findForAccount($account)
    {
        return User::where('account', '=', $account)->firstOrFail();
    }
}