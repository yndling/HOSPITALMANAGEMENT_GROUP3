<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BillModel;
use App\Models\PaymentModel;
use App\Models\PatientModel;

class AccountantController extends BaseController
{
    protected $billModel;
    protected $paymentModel;
    protected $patientModel;
    protected $session;

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session = session();
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'accountant') {
            return redirect()->to('/login');
        }

        $this->billModel = new BillModel();
        $this->paymentModel = new PaymentModel();
        $this->patientModel = new PatientModel();
    }

    public function index()
    {
        return redirect()->to('/accountant/billing');
    }

    public function billing()
    {
        $data['bills'] = $this->billModel->getBills();
        $data['totalBills'] = $this->billModel->getTotalBills();
        $data['pendingPayments'] = $this->billModel->getPendingPaymentsCount();
        $data['totalRevenue'] = $this->billModel->getTotalRevenue();
        return view('auth/accountant/billing', $data);
    }

    public function manageBills()
    {
        $data['bills'] = $this->billModel->getBills();
        $data['total'] = $this->billModel->getTotalBills();
        return view('auth/accountant/bills', $data);
    }

    public function reports()
    {
        $data['totalRevenue'] = $this->billModel->getTotalRevenue();
        $data['totalPayments'] = $this->paymentModel->getTotalPaymentsAmount();
        $data['pendingPayments'] = $this->billModel->getPendingPaymentsCount();
        $data['totalBills'] = $this->billModel->getTotalBills();

        // Get bills and payments for transaction history
        $data['bills'] = $this->billModel->getBills(50); // Get last 50 bills
        $data['payments'] = $this->paymentModel->getPayments(50); // Get last 50 payments

        // Calculate monthly growth (simplified - you can enhance this)
        $data['monthlyGrowth'] = '+12%'; // Placeholder

        return view('auth/accountant/reports', $data);
    }

    public function createBill()
    {
        $data['patients'] = $this->patientModel->findAll();
        return view('auth/accountant/bill_form', $data);
    }

    public function storeBill()
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'amount' => $this->request->getPost('amount'),
            'status' => $this->request->getPost('status') ?? 'unpaid',
            'due_date' => $this->request->getPost('due_date'),
        ];

        if ($this->billModel->insert($data)) {
            $this->session->setFlashdata('success', 'Bill created successfully!');
            return redirect()->to('/accountant/manage-bills');
        } else {
            $this->session->setFlashdata('error', 'Failed to create bill');
            return redirect()->back()->withInput();
        }
    }

    public function editBill($id)
    {
        $data['bill'] = $this->billModel->find($id);
        $data['patients'] = $this->patientModel->findAll();

        if (!$data['bill']) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/accountant/manage-bills');
        }

        return view('auth/accountant/bill_form', $data);
    }

    public function updateBill($id)
    {
        $data = [
            'patient_id' => $this->request->getPost('patient_id'),
            'amount' => $this->request->getPost('amount'),
            'status' => $this->request->getPost('status'),
            'due_date' => $this->request->getPost('due_date'),
        ];

        if ($this->billModel->update($id, $data)) {
            $this->session->setFlashdata('success', 'Bill updated successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to update bill');
        }

        return redirect()->to('/accountant/manage-bills');
    }

    public function deleteBill($id)
    {
        if ($this->billModel->delete($id)) {
            $this->session->setFlashdata('success', 'Bill deleted successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete bill');
        }

        return redirect()->to('/accountant/manage-bills');
    }

    public function createInvoice($id)
    {
        $data['bill'] = $this->billModel->getBill($id);
        if (!$data['bill']) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/accountant/manage-bills');
        }

        $data['payments'] = $this->paymentModel->getPaymentsByBill($id);

        return view('auth/accountant/invoice', $data);
    }

    public function recordPayment($id)
    {
        $data['bill'] = $this->billModel->getBill($id);
        if (!$data['bill']) {
            $this->session->setFlashdata('error', 'Bill not found');
            return redirect()->to('/accountant/manage-bills');
        }

        $data['payments'] = $this->paymentModel->getPaymentsByBill($id);

        return view('auth/accountant/payment_form', $data);
    }

    public function storePayment()
    {
        $billId = $this->request->getPost('bill_id');
        $amountPaid = $this->request->getPost('amount_paid');

        $data = [
            'bill_id' => $billId,
            'amount_paid' => $amountPaid,
            'payment_date' => $this->request->getPost('payment_date') ?? date('Y-m-d H:i:s'),
            'method' => $this->request->getPost('method') ?? 'Cash',
        ];

        if ($this->paymentModel->insert($data)) {
            // Check if bill is fully paid
            $totalPaid = $this->paymentModel->getTotalPaidForBill($billId);
            $bill = $this->billModel->find($billId);

            if ($totalPaid >= $bill['amount']) {
                $this->billModel->update($billId, ['status' => 'paid']);
            }

            $this->session->setFlashdata('success', 'Payment recorded successfully!');
        } else {
            $this->session->setFlashdata('error', 'Failed to record payment');
        }

        return redirect()->to('/accountant/manage-bills');
    }
}
