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
        'name', // For backward compatibility
        'date_of_birth',
        'age',
        'gender',
        'blood_type',
        'civil_status',
        'nationality',
        'occupation',
        'religion',
        'contact_number',
        'contact', // For backward compatibility
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
        'insurance_provider',
        'insurance_number',
        'patient_type',
        'assigned_doctor',
        'department',
        'reason_for_visit',
        'profile_photo',
        'qr_code',
        'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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
     * Get patients with optional search and pagination
     */
    public function getPatients($search = null, $limit = null, $offset = null)
    {
        $builder = $this->builder();

        if ($search) {
            $builder->groupStart()
                    ->like('first_name', $search)
                    ->orLike('last_name', $search)
                    ->orLike('patient_id', $search)
                    ->orLike('contact_number', $search)
                    ->groupEnd();
        }

        if ($limit) {
            $builder->limit($limit, $offset);
        }

        return $builder->get()->getResultArray();
    }

    /**
     * Get total number of patients
     */
    public function getTotalPatients()
    {
        return $this->countAllResults();
    }

    /**
     * Create a new patient
     */
    public function createPatient($data)
    {
        // Generate patient ID if not provided
        if (!isset($data['patient_id']) || empty($data['patient_id'])) {
            $data['patient_id'] = $this->generatePatientId();
        }

        // Create full name for backward compatibility
        if (!isset($data['name']) || empty($data['name'])) {
            $data['name'] = trim($data['first_name'] . ' ' . ($data['middle_name'] ?? '') . ' ' . $data['last_name']);
        }

        return $this->insert($data);
    }

    /**
     * Update patient information
     */
    public function updatePatient($id, $data)
    {
        // Update full name if name components changed
        if (isset($data['first_name']) || isset($data['middle_name']) || isset($data['last_name'])) {
            $patient = $this->find($id);
            if ($patient) {
                $firstName = $data['first_name'] ?? $patient['first_name'];
                $middleName = $data['middle_name'] ?? $patient['middle_name'];
                $lastName = $data['last_name'] ?? $patient['last_name'];
                $data['name'] = trim($firstName . ' ' . ($middleName ?? '') . ' ' . $lastName);
            }
        }

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
     * Get patient by ID
     */
    public function getPatient($id)
    {
        return $this->find($id);
    }

    /**
     * Search patients
     */
    public function searchPatients($keyword)
    {
        return $this->like('first_name', $keyword)
                    ->orLike('last_name', $keyword)
                    ->orLike('patient_id', $keyword)
                    ->orLike('contact_number', $keyword)
                    ->findAll();
    }

    /**
     * Generate unique patient ID
     */
    private function generatePatientId()
    {
        $year = date('Y');
        $count = $this->where('YEAR(created_at)', $year)->countAllResults() + 1;
        return 'P' . $year . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get patients by doctor
     */
    public function getPatientsByDoctor($doctorId)
    {
        return $this->where('assigned_doctor', $doctorId)->findAll();
    }

    /**
     * Get patients by department
     */
    public function getPatientsByDepartment($department)
    {
        return $this->where('department', $department)->findAll();
    }

    /**
     * Get recent patients
     */
    public function getRecentPatients($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')->limit($limit)->findAll();
    }

    /**
     * Get patient statistics
     */
    public function getPatientStats()
    {
        $total = $this->countAllResults();
        $male = $this->where('gender', 'Male')->countAllResults();
        $female = $this->where('gender', 'Female')->countAllResults();
        $today = $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults();

        return [
            'total' => $total,
            'male' => $male,
            'female' => $female,
            'today' => $today
        ];
    }
}
