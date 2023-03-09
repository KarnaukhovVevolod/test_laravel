<?php

namespace App\Repositories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;


class UsersRepository
{
    protected Users $users;
    public function __construct()
    {
        $this->users = app(Users::class);
    }
    public function getAllDataUsers(): Collection
    {
        return $this->users::all();
    }

}
