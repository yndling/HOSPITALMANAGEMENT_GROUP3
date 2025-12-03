<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table            = 'bills';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'patient_id',
        'amount',
        'status',
        'due_date'
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
        'amount'     => 'required|decimal|greater_than[0]',
        'status'     => 'permit_empty|in_list[paid,unpaid,pending]',
        'due_date'   => 'permit_empty|valid_date[Y-m-d]'
    ];

    protected $validationMessages = [
        'patient_id' => [
            'required'       => 'Patient is required',
            'integer'        => 'Invalid patient ID',
            'is_not_unique'  => 'Patient does not exist'
        ],
        'amount' => [
            'required'      => 'Amount is required',
            'decimal'       => 'Amount must be a valid decimal number',
            'greater_than'  => 'Amount must be greater than 0'
        ],
        'status' => [
            'in_list' => 'Invalid status value'
        ],
        'due_date' => [
            'valid_date' => 'Please enter a valid due date (YYYY-MM-DD)'
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
     * Get all bills with patient details
     */
    public function getBills($limit = 10, $offset = 0)
    {
        return $this->select('bills.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->orderBy('bills.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get bill by ID with patient details
     */
    public function getBill($id)
    {
        return $this->select('bills.*, patients.name as patient_name, patients.contact, patients.age, patients.gender')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->find($id);
    }

    /**
     * Create new bill
     */
    public function createBill($data)
    {
        return $this->insert($data);
    }

    /**
     * Update bill
     */
    public function updateBill($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete bill
     */
    public function deleteBill($id)
    {
        return $this->delete($id);
    }

    /**
     * Get bills by patient ID
     */
    public function getBillsByPatient($patient_id)
    {
        return $this->where('patient_id', $patient_id)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get bills by status
     */
    public function getBillsByStatus($status)
    {
        return $this->select('bills.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->where('bills.status', $status)
                    ->orderBy('bills.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Update bill status
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Get total bills count
     */
    public function getTotalBills()
    {
        return $this->countAll();
    }

    /**
     * Get total revenue (paid bills)
     */
    public function getTotalRevenue()
    {
        return $this->where('status', 'paid')->selectSum('amount')->get()->getRow()->amount ?? 0;
    }

    /**
     * Get pending payments count
     */
    public function getPendingPaymentsCount()
    {
        return $this->whereIn('status', ['unpaid', 'pending'])->countAllResults();
    }

    /**
     * Search bills by patient name
     */
    public function searchBills($keyword)
    {
        return $this->select('bills.*, patients.name as patient_name, patients.contact')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->like('patients.name', $keyword)
                    ->orderBy('bills.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get monthly revenue for a specific month and year
     * 
     * @param int $month Month (1-12)
     * @param int $year Year (e.g., 2023)
     * @return float Total revenue for the specified month and year
     */
    public function getMonthlyRevenue($month, $year)
    {
        // Ensure month is 2 digits
        $month = str_pad($month, 2, '0', STR_PAD_LEFT);
        
        // Format the date range for the query
        $startDate = "{$year}-{$month}-01";
        $endDate = date('Y-m-t', strtotime($startDate)); // Last day of the month
        
        // Query to get sum of paid bills for the specified month
        $result = $this->selectSum('amount')
                      ->where('status', 'paid')
                      ->where('DATE(created_at) >=', $startDate)
                      ->where('DATE(created_at) <=', $endDate)
                      ->first();
        
        return (float)($result['amount'] ?? 0);
    }
}
