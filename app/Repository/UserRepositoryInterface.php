<?php
/**
 * Created by PhpStorm.
 * User: alucky
 * Date: 17/09/04
 * Time: 10:52
 */

namespace App\Repository;

interface UserRepositoryInterface
{
    public function findAll();

    public function findForAccount($account);
}
