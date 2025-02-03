<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'phone', 'email', 'address'];
    protected $useTimestamps = true;

    public function getRepresentatives($customerId)
    {
        $representativeModel = new RepresentativeModel();
        return $representativeModel->where('customer_id', $customerId)->findAll();
    }
}
