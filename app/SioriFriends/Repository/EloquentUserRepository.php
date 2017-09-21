<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/21
 * Time: 11:42
 */

namespace App\Siorifriends\Repository;

use App\Siorifriends\Models\User\User;
use App\Siorifriends\Models\User\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentUserRepository implements UserRepository
{

    /**
     * ユーザを追加する。
     *
     * @param User $user
     * @return void
     */
    public function add(User $user): void
    {
        $user->save();
    }

    /**
     * ユーザの一覧を取得する。
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return User::all();
    }

    /**
     * id でユーザを取得する。
     *
     * @param string $userId
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(string $userId): User
    {
        return User::find($userId);
    }

    /**
     * account でユーザを取得する。
     *
     * @param string $account
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByAccount(string $account): User
    {
        return User::where('account', $account);
    }

    /**
     * ユーザの変更を保存する。
     *
     * @param User $user 変更されたユーザ。
     * @return bool
     */
    public function save(User $user): bool
    {
        return $user->save();
    }

    /**
     * ユーザを削除する。
     *
     * @param User $user
     * @return bool 削除できたらtrue, そうでなければfalseを返す。
     */
    public function remove(User $user): bool
    {
        return $user->delete();
    }
}
