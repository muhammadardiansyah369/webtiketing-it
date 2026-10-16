<?php

namespace App\Models;

use CodeIgniter\Model;

class aktivitasModel extends Model
{
    protected $table = 'aktivitas';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'tiket_id',
        'user_id',
        'aktivitas'
    ];

    protected $useTimestamps = true;
}