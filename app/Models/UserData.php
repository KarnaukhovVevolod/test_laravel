<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserData.
 *
 * @property int id
 * @property int $client_id
 * @property string $data_user
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 */
class UserData extends Model
{
    protected $table = 'table_for_data_users';
    protected $guarded = [
        'client_id',
        'data_user',
        'created_at',
        'updated_at',
    ];

}
