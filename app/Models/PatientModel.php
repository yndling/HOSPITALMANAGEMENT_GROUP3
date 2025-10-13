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
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'age',
        'gender',
        'address',
        'contact'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name'    => 'required|min_length[3]|max_length[100]',
        'age'     => 'permit_empty|integer|greater_than[0]|less_than[150]',
        'gender'  => 'required|in_list[Male,Female,Other]',
        'address' => 'permit_empty|max_length[255]',
        'contact' => 'permit_empty|max_length[20]'
    ];

    protected $validationMessages = [
        'name' => [
            'required'    => 'Patient name is required',
            'min_length'  => 'Name must be at least 3 characters long',
            'max_length'  => 'Name cannot exceed 100 characters'
        ],
        'age' => [
            'integer'      => 'Age must be a valid number',
            'greater_than' => 'Age must be greater than 0',
            'less_than'    => 'Age must be less than 150'
        ],
        'gender' => [
            'required' => 'Gender is required',
            'in_list'  => 'Please select a valid gender option'
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Get all patients with pagination
     */
    public function getPatients($limit = 10, $offset = 0)
    {
        return $this->findAll($limit, $offset);
    }

    /**
     * Get patient by ID
     */
    public function getPatient($id)
    {
        return $this->find($id);
    }

    /**
     * Create new patient
     */
    public function createPatient($data)
    {
        return $this->insert($data);
    }

    /**
     * Update patient
     */
    public function updatePatient($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete patient
     */
    public function deletePatient($id)
    {
        return $this->delete($id);
    }

    /**
     * Search patients by name or contact
     */
    public function searchPatients($keyword)
    {
        return $this->like('name', $keyword)
                    ->orLike('contact', $keyword)
                    ->findAll();
    }

    /**
     * Get total patients count
     */
    public function getTotalPatients()
    {
        return $this->countAll();
    }
}
