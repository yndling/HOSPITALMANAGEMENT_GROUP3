<?php
namespace App\Models;

use CodeIgniter\Model;

class ReceptionistModel extends Model
{
    protected $DBGroup = 'default';

    // ---------------------------
    // Patients Table Methods
    // ---------------------------

    /**
     * Get all patients
     */
    public function getPatients()
    {
        return $this->db->table('patients')
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Get patient by ID
     */
    public function getPatientById($id)
    {
        return $this->db->table('patients')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Add new patient
     */
    public function addPatient(array $data)
    {
        return $this->db->table('patients')->insert($data);
    }

    /**
     * Update patient details
     */
    public function updatePatient($id, array $data)
    {
        return $this->db->table('patients')
                        ->where('id', $id)
                        ->update($data);
    }

    /**
     * Delete patient by ID
     */
    public function deletePatient($id)
    {
        return $this->db->table('patients')->delete(['id' => $id]);
    }

    // ---------------------------
    // Appointments Table Methods
    // ---------------------------

    /**
     * Get all appointments (with patient info)
     */
    public function getAppointments()
    {
        return $this->db->table('appointments')
                        ->select('appointments.*, patients.name as patient_name')
                        ->join('patients', 'patients.id = appointments.patient_id', 'left')
                        ->orderBy('appointments.date', 'DESC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Get appointment by ID
     */
    public function getAppointmentById($id)
    {
        return $this->db->table('appointments')
                        ->where('id', $id)
                        ->get()
                        ->getRowArray();
    }

    /**
     * Add new appointment
     */
    public function addAppointment(array $data)
    {
        return $this->db->table('appointments')->insert($data);
    }

    /**
     * Update appointment details
     */
    public function updateAppointment($id, array $data)
    {
        return $this->db->table('appointments')
                        ->where('id', $id)
                        ->update($data);
    }

    /**
     * Delete appointment by ID
     */
    public function deleteAppointment($id)
    {
        return $this->db->table('appointments')->delete(['id' => $id]);
    }
}
