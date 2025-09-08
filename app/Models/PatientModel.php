<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table            = 'patients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name',
        'age',
        'gender',
        'address',
        'phone',
        'created_at',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name'   => 'required|min_length[3]',
        'age'    => 'permit_empty|integer',
        'gender' => 'permit_empty|in_list[Male,Female]',
        'phone'  => 'permit_empty|min_length[10]|max_length[20]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'   => 'Patient name is required.',
            'min_length' => 'Name must have at least 3 characters.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // ✅ Callbacks enabled
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['setDefaultPhone', 'logBeforeInsert'];
    protected $afterInsert    = ['logAfterInsert'];
    protected $beforeUpdate   = ['logBeforeUpdate'];
    protected $afterUpdate    = ['logAfterUpdate'];
    protected $beforeFind     = ['logBeforeFind'];
    protected $afterFind      = ['logAfterFind'];
    protected $beforeDelete   = ['logBeforeDelete'];
    protected $afterDelete    = ['logAfterDelete'];

    // ----------------------
    // Callback Functions
    // ----------------------

    // Example: kung walang phone, set default value
    protected function setDefaultPhone(array $data)
    {
        if (empty($data['data']['phone'])) {
            $data['data']['phone'] = 'N/A';
        }
        return $data;
    }

    protected function logBeforeInsert(array $data)
    {
        log_message('info', 'About to insert a new patient: ' . json_encode($data));
        return $data;
    }

    protected function logAfterInsert(array $data)
    {
        log_message('info', 'New patient inserted successfully.');
        return $data;
    }

    protected function logBeforeUpdate(array $data)
    {
        log_message('info', 'About to update patient: ' . json_encode($data));
        return $data;
    }

    protected function logAfterUpdate(array $data)
    {
        log_message('info', 'Patient updated successfully.');
        return $data;
    }

    protected function logBeforeFind(array $data)
    {
        log_message('info', 'Fetching patient records...');
        return $data;
    }

    protected function logAfterFind(array $data)
    {
        log_message('info', 'Patient records fetched.');
        return $data;
    }

    protected function logBeforeDelete(array $data)
    {
        log_message('info', 'About to delete patient record: ' . json_encode($data));
        return $data;
    }

    protected function logAfterDelete(array $data)
    {
        log_message('info', 'Patient record deleted.');
        return $data;
    }
}
