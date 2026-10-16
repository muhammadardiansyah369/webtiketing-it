<?php

namespace App\Models;

use CodeIgniter\Model;

class categoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['category'];
}
