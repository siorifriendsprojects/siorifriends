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
    /**
     * User の一覧を返す。
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findAll()
    {
        return User::all();
    }

    /**
     * Get User from account name.
     *
     * @param $account
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function findForAccount($account)
    {
        return User::where('account', '=', $account)->firstOrFail();
    }
}
