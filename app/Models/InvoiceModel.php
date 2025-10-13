<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'bill_id',
        'invoice_number',
        'issued_date',
        'due_date',
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
        'bill_id'        => 'required|integer|is_not_unique[bills.id]',
        'invoice_number' => 'required|is_unique[invoices.invoice_number]|max_length[100]',
        'issued_date'    => 'permit_empty|valid_date[Y-m-d H:i:s]',
        'due_date'       => 'permit_empty|valid_date[Y-m-d]',
        'status'         => 'permit_empty|in_list[unpaid,paid,overdue]'
    ];

    protected $validationMessages = [
        'bill_id' => [
            'required'       => 'Bill is required',
            'integer'        => 'Invalid bill ID',
            'is_not_unique'  => 'Bill does not exist'
        ],
        'invoice_number' => [
            'required'     => 'Invoice number is required',
            'is_unique'    => 'Invoice number must be unique',
            'max_length'   => 'Invoice number cannot exceed 100 characters'
        ],
        'issued_date' => [
            'valid_date' => 'Please enter a valid issued date'
        ],
        'due_date' => [
            'valid_date' => 'Please enter a valid due date (YYYY-MM-DD)'
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
     * Get all invoices with bill and patient details
     */
    public function getInvoices($limit = 10, $offset = 0)
    {
        return $this->select('invoices.*, bills.amount, bills.patient_id, patients.name as patient_name, patients.contact')
                    ->join('bills', 'bills.id = invoices.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->orderBy('invoices.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get invoice by ID with full details
     */
    public function getInvoice($id)
    {
        return $this->select('invoices.*, bills.amount, bills.patient_id, bills.due_date as bill_due_date, patients.name as patient_name, patients.contact, patients.age, patients.gender, patients.address')
                    ->join('bills', 'bills.id = invoices.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->find($id);
    }

    /**
     * Create new invoice
     */
    public function createInvoice($data)
    {
        // Auto-generate invoice number if not provided
        if (empty($data['invoice_number'])) {
            $data['invoice_number'] = $this->generateInvoiceNumber();
        }

        // Set issued date if not provided
        if (empty($data['issued_date'])) {
            $data['issued_date'] = date('Y-m-d H:i:s');
        }

        return $this->insert($data);
    }

    /**
     * Update invoice
     */
    public function updateInvoice($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete invoice
     */
    public function deleteInvoice($id)
    {
        return $this->delete($id);
    }

    /**
     * Get invoices by bill ID
     */
    public function getInvoicesByBill($bill_id)
    {
        return $this->where('bill_id', $bill_id)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get invoices by patient ID
     */
    public function getInvoicesByPatient($patient_id)
    {
        return $this->select('invoices.*, bills.amount, bills.patient_id')
                    ->join('bills', 'bills.id = invoices.bill_id')
                    ->where('bills.patient_id', $patient_id)
                    ->orderBy('invoices.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get invoices by status
     */
    public function getInvoicesByStatus($status)
    {
        return $this->select('invoices.*, bills.amount, bills.patient_id, patients.name as patient_name, patients.contact')
                    ->join('bills', 'bills.id = invoices.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->where('invoices.status', $status)
                    ->orderBy('invoices.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Update invoice status
     */
    public function updateStatus($id, $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Get total invoices count
     */
    public function getTotalInvoices()
    {
        return $this->countAll();
    }

    /**
     * Generate unique invoice number
     */
    private function generateInvoiceNumber()
    {
        $prefix = 'INV-';
        $date = date('Ymd');
        $count = $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults() + 1;
        return $prefix . $date . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Search invoices by patient name or invoice number
     */
    public function searchInvoices($keyword)
    {
        return $this->select('invoices.*, bills.amount, bills.patient_id, patients.name as patient_name, patients.contact')
                    ->join('bills', 'bills.id = invoices.bill_id')
                    ->join('patients', 'patients.id = bills.patient_id')
                    ->groupStart()
                        ->like('patients.name', $keyword)
                        ->orLike('invoices.invoice_number', $keyword)
                    ->groupEnd()
                    ->orderBy('invoices.created_at', 'DESC')
                    ->findAll();
    }
}

