<?php

namespace App\Models;

use CodeIgniter\Model;

class attachmentsModel extends Model
{
    protected $table = 'attachments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ticket_id', 'file_name', 'file_path'];
}
