<?php

namespace App\Models;

use CodeIgniter\Model;

class RepresentativeModel extends Model
{
    protected $table = 'representatives';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'name', 'surname', 'phone', 'email'];
    protected $useTimestamps = true;
}
