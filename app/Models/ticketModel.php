<?php

namespace App\Models;

use CodeIgniter\Model;

class ticketModel extends Model
{

    protected $useTimestamps = true;
    protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_tiket',
        'user_id',
        'category_id',
        'gambar',
        'ditugaskan',
        'subjek',
        'deskripsi',
        'status',
        'Closed_at'
    ];
}
