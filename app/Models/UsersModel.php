<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'department',
        'reset_token',
        'reset_token_expires'
    ];
}
