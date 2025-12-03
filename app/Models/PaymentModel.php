<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bill_id',
        'amount_paid',
        'payment_date',
        'method'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'bill_id'      => 'required|integer|is_not_unique[bills.id]',
        'amount_paid'  => 'required|decimal|greater_than[0]',
        'payment_date' => 'required|valid_date[Y-m-d\TH:i]',
        'method'       => 'permit_empty|in_list[Cash,Card,Bank Transfer,Online,UPI]'
    ];

    protected $validationMessages = [
        'bill_id' => [
            'required'       => 'Bill is required',
            'integer'        => 'Invalid bill ID',
            'is_not_unique'  => 'Bill does not exist'
        ],
        'amount_paid' => [
            'required'     => 'Amount paid is required',
            'decimal'      => 'Amount must be a valid decimal number',
            'greater_than' => 'Amount must be greater than 0'
        ],
        'payment_date' => [
            'valid_date' => 'Please enter a valid payment date'
        ],
        'method' => [
            'in_list' => 'Invalid payment method'
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
     * Get all payments with bill and patient details
     */
    public function getPayments($limit = 10, $offset = 0)
    {
        return $this->select('payments.*, bills.amount as bill_amount, bills.patient_id, patients.name as patient_name, patients.contact')
                    ->join('bills', 'bills.id = payments.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->orderBy('payments.payment_date', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get payment by ID with full details
     */
    public function getPayment($id)
    {
        return $this->select('payments.*, bills.amount as bill_amount, bills.patient_id, bills.status as bill_status, patients.name as patient_name, patients.contact, patients.age, patients.gender')
                    ->join('bills', 'bills.id = payments.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->find($id);
    }

    /**
     * Create new payment
     */
    public function createPayment($data)
    {
        // Set payment date if not provided
        if (empty($data['payment_date'])) {
            $data['payment_date'] = date('Y-m-d H:i:s');
        }

        return $this->insert($data);
    }

    /**
     * Update payment
     */
    public function updatePayment($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete payment
     */
    public function deletePayment($id)
    {
        return $this->delete($id);
    }

    /**
     * Get payments by bill ID
     */
    public function getPaymentsByBill($bill_id)
    {
        return $this->where('bill_id', $bill_id)
                    ->orderBy('payment_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get payments by patient ID
     */
    public function getPaymentsByPatient($patient_id)
    {
        return $this->select('payments.*, bills.amount as bill_amount, bills.patient_id')
                    ->join('bills', 'bills.id = payments.bill_id')
                    ->where('bills.patient_id', $patient_id)
                    ->orderBy('payments.payment_date', 'DESC')
                    ->findAll();
    }

    /**
     * Get total payments amount for a bill
     */
    public function getTotalPaidForBill($bill_id)
    {
        return $this->where('bill_id', $bill_id)->selectSum('amount_paid')->get()->getRow()->amount_paid ?? 0;
    }

    /**
     * Get total payments count
     */
    public function getTotalPayments()
    {
        return $this->countAll();
    }

    /**
     * Get total payments amount
     */
    public function getTotalPaymentsAmount()
    {
        return $this->selectSum('amount_paid')->get()->getRow()->amount_paid ?? 0;
    }

    /**
     * Search payments by patient name
     */
    public function searchPayments($keyword)
    {
        return $this->select('payments.*, bills.amount as bill_amount, bills.patient_id, patients.name as patient_name, patients.contact')
                    ->join('bills', 'bills.id = payments.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->like('patients.name', $keyword)
                    ->orderBy('payments.payment_date', 'DESC')
                    ->findAll();
    }
}
