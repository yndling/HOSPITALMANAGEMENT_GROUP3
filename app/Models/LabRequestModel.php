<?php

namespace App\Models;

use CodeIgniter\Model;

class LabRequestModel extends Model
{
    protected $table      = 'lab_requests';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'patient',
        'test',
        'status',
        'patient_id',
        'test_type',
        'doctor_id',
        'notes'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
