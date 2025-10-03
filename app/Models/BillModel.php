<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'id';
    protected $allowedFields = ['patient_id', 'amount', 'status', 'due_date'];
    protected $useTimestamps = true;
}
