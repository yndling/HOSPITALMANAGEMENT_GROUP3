<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MedicineModel;
use App\Models\PrescriptionModel;
use App\Models\PrescriptionItemModel;

class PharmacyController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'pharmacist') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/pharmacy/dashboard');
    }

    public function dashboard()
    {
        $medicineModel = new MedicineModel();
        $prescriptionModel = new PrescriptionModel();

        $data = [
            'totalMedicines' => $medicineModel->countAllResults(),
            'pendingPrescriptions' => $prescriptionModel->where('status', 'pending')->countAllResults(),
            'dispensedPrescriptions' => $prescriptionModel->where('status', 'dispensed')->countAllResults()
        ];

        return view('auth/pharmacy/dashboard', $data);
    }

    public function medicines()
    {
        $medicineModel = new MedicineModel();
        $data['medicines'] = $medicineModel->findAll();
        return view('auth/pharmacy/medicines', $data);
    }

    public function prescriptions()
    {
        $prescriptionModel = new PrescriptionModel();
        $data['prescriptions'] = $prescriptionModel
            ->select('prescriptions.*, patients.name as patient_name')
            ->join('patients', 'patients.id = prescriptions.patient_id')
            ->orderBy('prescriptions.prescription_date', 'DESC')
            ->findAll();
        
        return view('auth/pharmacy/prescriptions', $data);
    }

    public function addMedicine()
    {
        return view('auth/pharmacy/medicine_form');
    }

    public function storeMedicine()
    {
        $medicineModel = new MedicineModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'generic_name' => $this->request->getPost('generic_name'),
            'category' => $this->request->getPost('category'),
            'dosage_form' => $this->request->getPost('dosage_form'),
            'strength' => $this->request->getPost('strength'),
            'manufacturer' => $this->request->getPost('manufacturer'),
            'batch_number' => $this->request->getPost('batch_number'),
            'expiry_date' => $this->request->getPost('expiry_date'),
            'quantity' => $this->request->getPost('quantity'),
            'unit_price' => $this->request->getPost('unit_price'),
            'selling_price' => $this->request->getPost('selling_price'),
            'min_stock_level' => $this->request->getPost('min_stock_level'),
            'supplier' => $this->request->getPost('supplier'),
            'location' => $this->request->getPost('location'),
            'status' => 'active',
        ];

        $medicineModel->insert($data);
        return redirect()->to('/pharmacy/medicines')->with('success', 'Medicine added successfully');
    }

    public function editMedicine($id)
    {
        $medicineModel = new MedicineModel();
        $data['medicine'] = $medicineModel->find($id);
        return view('auth/pharmacy/medicine_form', $data);
    }

    public function updateMedicine($id)
    {
        $medicineModel = new MedicineModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'generic_name' => $this->request->getPost('generic_name'),
            'category' => $this->request->getPost('category'),
            'dosage_form' => $this->request->getPost('dosage_form'),
            'strength' => $this->request->getPost('strength'),
            'manufacturer' => $this->request->getPost('manufacturer'),
            'batch_number' => $this->request->getPost('batch_number'),
            'expiry_date' => $this->request->getPost('expiry_date'),
            'quantity' => $this->request->getPost('quantity'),
            'unit_price' => $this->request->getPost('unit_price'),
            'selling_price' => $this->request->getPost('selling_price'),
            'min_stock_level' => $this->request->getPost('min_stock_level'),
            'supplier' => $this->request->getPost('supplier'),
            'location' => $this->request->getPost('location'),
        ];

        $medicineModel->update($id, $data);
        return redirect()->to('/pharmacy/medicines')->with('success', 'Medicine updated successfully');
    }

    public function deleteMedicine($id)
    {
        $medicineModel = new MedicineModel();
        $medicineModel->delete($id);
        return redirect()->to('/pharmacy/medicines')->with('success', 'Medicine deleted successfully');
    }

    public function dispensePrescription($id)
    {
        $prescriptionModel = new PrescriptionModel();
        $prescriptionItemModel = new PrescriptionItemModel();
        $medicineModel = new MedicineModel();

        $prescription = $prescriptionModel->find($id);
        $items = $prescriptionItemModel->where('prescription_id', $id)->findAll();

        foreach ($items as $item) {
            $medicine = $medicineModel->find($item['medicine_id']);
            if ($medicine['quantity'] >= $item['quantity']) {
                $medicineModel->update($item['medicine_id'], [
                    'quantity' => $medicine['quantity'] - $item['quantity']
                ]);

                $prescriptionItemModel->update($item['id'], [
                    'dispensed_quantity' => $item['quantity'],
                    'status' => 'dispensed'
                ]);
            }
        }

        $prescriptionModel->update($id, ['status' => 'dispensed']);
        return redirect()->to('/pharmacy/prescriptions')->with('success', 'Prescription dispensed successfully');
    }
}
