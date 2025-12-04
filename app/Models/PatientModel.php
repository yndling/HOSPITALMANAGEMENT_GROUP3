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
        'patient_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'age',
        'gender',
        'blood_type',
        'civil_status',
        'nationality',
        'contact_number',
        'email_address',
        'home_address',
        'emergency_contact_name',
        'emergency_relationship',
        'emergency_contact_number',
        'emergency_address',
        'medical_history',
        'current_medications',
        'allergies',
        'past_surgeries',
        'chronic_conditions',
        'family_medical_history',
        'blood_pressure',
        'temperature',
        'pulse',
        'respiratory_rate',
        'oxygen_level',
        'weight',
        'height',
        'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'patient_id'                => 'permit_empty|is_unique[patients.patient_id]',
        'first_name'                => 'required|min_length[1]|max_length[50]',
        'middle_name'               => 'permit_empty|max_length[50]',
        'last_name'                 => 'required|min_length[1]|max_length[50]',
        'date_of_birth'             => 'permit_empty|valid_date[Y-m-d]',
        'age'                       => 'permit_empty|integer|greater_than[0]|less_than[150]',
        'gender'                    => 'required|in_list[Male,Female,Other]',
        'blood_type'                => 'permit_empty|in_list[A+,A-,B+,B-,AB+,AB-,O+,O-]',
        'civil_status'              => 'permit_empty|in_list[Single,Married,Divorced,Widowed]',
        'nationality'               => 'permit_empty|max_length[50]',
        'contact_number'            => 'permit_empty|max_length[20]',
        'email_address'             => 'permit_empty|valid_email|max_length[100]',
        'home_address'              => 'permit_empty|max_length[255]',
        'emergency_contact_name'    => 'permit_empty|max_length[100]',
        'emergency_relationship'    => 'permit_empty|max_length[50]',
        'emergency_contact_number'  => 'permit_empty|max_length[20]',
        'emergency_address'         => 'permit_empty|max_length[255]',
        'medical_history'           => 'permit_empty|max_length[1000]',
        'current_medications'       => 'permit_empty|max_length[1000]',
        'allergies'                 => 'permit_empty|max_length[1000]',
        'past_surgeries'            => 'permit_empty|max_length[1000]',
        'chronic_conditions'        => 'permit_empty|max_length[1000]',
        'family_medical_history'    => 'permit_empty|max_length[1000]',
        'blood_pressure'            => 'permit_empty|string|max_length[20]',
        'temperature'               => 'permit_empty|decimal',
        'pulse'                     => 'permit_empty|integer|greater_than[0]',
        'respiratory_rate'          => 'permit_empty|integer|greater_than[0]',
        'oxygen_level'              => 'permit_empty|integer|greater_than[0]|less_than_equal_to[100]',
        'weight'                    => 'permit_empty|decimal',
        'height'                    => 'permit_empty|decimal',
        'notes'                     => 'permit_empty|string|max_length[1000]'
    ];

    protected $validationMessages = [
        'patient_id' => [
            'is_unique' => 'Patient ID must be unique'
        ],
        'first_name' => [
            'required'    => 'First name is required',
            'min_length'  => 'First name must be at least 1 character long',
            'max_length'  => 'First name cannot exceed 50 characters'
        ],
        'last_name' => [
            'required'    => 'Last name is required',
            'min_length'  => 'Last name must be at least 1 character long',
            'max_length'  => 'Last name cannot exceed 50 characters'
        ],
        'date_of_birth' => [
            'valid_date' => 'Please enter a valid date of birth'
        ],
        'age' => [
            'integer'      => 'Age must be a valid number',
            'greater_than' => 'Age must be greater than 0',
            'less_than'    => 'Age must be less than 150'
        ],
        'gender' => [
            'required' => 'Gender is required',
            'in_list'  => 'Please select a valid gender option'
        ],
        'blood_type' => [
            'in_list' => 'Please select a valid blood type'
        ],
        'civil_status' => [
            'in_list' => 'Please select a valid civil status'
        ],
        'email_address' => [
            'valid_email' => 'Please enter a valid email address',
            'max_length'  => 'Email address cannot exceed 100 characters'
        ],
        'emergency_contact_name' => [
            'max_length' => 'Emergency contact name cannot exceed 100 characters'
        ],
        'emergency_relationship' => [
            'max_length' => 'Emergency relationship cannot exceed 50 characters'
        ],
        'medical_history' => [
            'max_length' => 'Medical history cannot exceed 1000 characters'
        ],
        'current_medications' => [
            'max_length' => 'Current medications cannot exceed 1000 characters'
        ],
        'allergies' => [
            'max_length' => 'Allergies cannot exceed 1000 characters'
        ],
        'past_surgeries' => [
            'max_length' => 'Past surgeries cannot exceed 1000 characters'
        ],
        'chronic_conditions' => [
            'max_length' => 'Chronic conditions cannot exceed 1000 characters'
        ],
        'family_medical_history' => [
            'max_length' => 'Family medical history cannot exceed 1000 characters'
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
