<?php

namespace App\Repositories;

use App\Models\UserData;
use App\Models\Users;
use Illuminate\Database\Eloquent\Collection;

class UserDataRepository
{
    protected UserData $userData;
    public function __construct()
    {
        $this->userData = app(UserData::class);
    }

    public function getAllDataObjectsUsers(): Collection
    {
        $objects = $this->userData::all();
        return $objects;
    }
}
