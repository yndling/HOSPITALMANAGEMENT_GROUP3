<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bill_id', 'invoice_number', 'issued_date', 'status'];
    protected $useTimestamps = true;
}

