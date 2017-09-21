<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/21
 * Time: 11:32
 */

namespace App\Siorifriends\Models\User;



use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface UserRepository
{
    /**
     * ユーザを追加する。
     *
     * @param User $user
     * @return void
     */
    public function add(User $user): void;

    /**
     * ユーザの一覧を取得する。
     *
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * id でユーザを取得する。
     *
     * @param string $userId
     * @return User
     * @throws ModelNotFoundException
     */
    public function findById(string $userId): User;

    /**
     * account でユーザを取得する。
     *
     * @param string $account
     * @return User
     * @throws ModelNotFoundException
     */
    public function findByAccount(string $account): User;

    /**
     * ユーザの変更を保存する。
     *
     * @param User $user 変更されたユーザ。
     * @return bool
     */
    public function save(User $user): bool;

    /**
     * ユーザを削除する。
     *
     * @param User $user
     * @return bool 削除できたらtrue, そうでなければfalseを返す。
     */
    public function remove(User $user): bool;
}
