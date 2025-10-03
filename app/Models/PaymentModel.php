<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['bill_id', 'amount_paid', 'payment_date', 'method'];
    protected $useTimestamps = true;
}
