<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table            = 'appointments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'patient_id',
        'doctor',
        'date',
        'time',
        'status'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'patient_id' => 'required|integer|is_not_unique[patients.id]',
        'doctor'     => 'required|min_length[3]|max_length[100]',
        'date'       => 'required|valid_date[Y-m-d]',
        'time'       => 'required|valid_date[H:i:s]',
        'status'     => 'permit_empty|in_list[Pending,Confirmed,Completed,Cancelled,No Show]'
    ];

    protected $validationMessages = [
        'patient_id' => [
            'required'       => 'Patient is required',
            'integer'        => 'Invalid patient ID',
            'is_not_unique'  => 'Patient does not exist'
        ],
        'doctor' => [
            'required'   => 'Doctor name is required',
            'min_length' => 'Doctor name must be at least 3 characters',
            'max_length' => 'Doctor name cannot exceed 100 characters'
        ],
        'date' => [
            'required'   => 'Appointment date is required',
            'valid_date' => 'Please enter a valid date (YYYY-MM-DD)'
        ],
        'time' => [
            'required'   => 'Appointment time is required',
            'valid_date' => 'Please enter a valid time (HH:MM:SS)'
        ],
        'status' => [
            'in_list' => 'Invalid status value'
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
     * Get all appointments with patient details
     */
    public function getAppointments($limit = 10, $offset = 0)
    {
        return $this->select('appointments.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = appointments.patient_id')
                    ->orderBy('appointments.date', 'DESC')
                    ->orderBy('appointments.time', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get appointment by ID with patient details
     */
    public function getAppointment($id)
    {
        return $this->select('appointments.*, patients.name as patient_name, patients.contact, patients.age, patients.gender')
                    ->join('patients', 'patients.id = appointments.patient_id')
                    ->find($id);
    }

    /**
     * Create new appointment
     */
    public function createAppointment($data)
    {
        return $this->insert($data);
    }

    /**
     * Update appointment
     */
    public function updateAppointment($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete appointment
     */
    public function deleteAppointment($id)
    {
        return $this->delete($id);
    }

    /**
     * Get appointments by patient ID
     */
    public function getAppointmentsByPatient($patient_id)
    {
        return $this->where('patient_id', $patient_id)
                    ->orderBy('date', 'DESC')
                    ->orderBy('time', 'DESC')
                    ->findAll();
    }

    /**
     * Get appointments by date
     */
    public function getAppointmentsByDate($date)
    {
        return $this->select('appointments.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = appointments.patient_id')
                    ->where('appointments.date', $date)
                    ->orderBy('appointments.time', 'ASC')
                    ->findAll();
    }

    /**
     * Get appointments by status
     */
    public function getAppointmentsByStatus($status)
    {
        return $this->select('appointments.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = appointments.patient_id')
                    ->where('appointments.status', $status)
                    ->orderBy('appointments.date', 'DESC')
                    ->findAll();
    }

    /**
     * Update appointment status
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Get total appointments count
     */
    public function getTotalAppointments()
    {
        return $this->countAll();
    }

    /**
     * Search appointments by patient name or doctor
     */
    public function searchAppointments($keyword)
    {
        return $this->select('appointments.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = appointments.patient_id')
                    ->groupStart()
                        ->like('patients.name', $keyword)
                        ->orLike('appointments.doctor', $keyword)
                    ->groupEnd()
                    ->orderBy('appointments.date', 'DESC')
                    ->findAll();
    }
}
