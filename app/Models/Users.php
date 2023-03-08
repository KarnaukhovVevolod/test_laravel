<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $guarded = [
        'name',
        'email',
        'password',
        'login',
        'created_at',
        'updated_at',
        'remember_token',
        'login_verified_at'
    ];

}
