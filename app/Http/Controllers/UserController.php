<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepositoryInterface;

class UserController extends Controller
{
    private $user_repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->user_repository = $repository;
    }

    public function index()
    {
        return $this->user_repository->findAll()->toJson();
    }
}
