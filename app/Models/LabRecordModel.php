<?php

namespace App\Models;

use CodeIgniter\Model;

class LabRecordModel extends Model
{
    protected $table      = 'lab_records';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = ['patient', 'test', 'date'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
