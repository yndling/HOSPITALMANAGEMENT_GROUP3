<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LabSupplyModel;
use App\Models\LabRequestModel;
use App\Models\LabResultModel;

class LabController extends BaseController
{
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $session = session();
        if (!$session->get('isLoggedIn') || $session->get('role') !== 'laboratory_staff') {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return redirect()->to('/lab/requests');
    }

    public function supplies()
    {
        $labSupplyModel = new LabSupplyModel();
        $data['supplies'] = $labSupplyModel->findAll();
        return view('auth/lab/supplies', $data);
    }

    public function requests()
    {
        $labRequestModel = new LabRequestModel();
        $data['requests'] = $labRequestModel->findAll();
        return view('auth/lab/requests', $data);
    }

    public function results()
    {
        $labResultModel = new LabResultModel();
        $data['results'] = $labResultModel->findAll();
        return view('auth/lab/results', $data);
    }

    public function addSupply()
    {
        return view('auth/lab/supply_form');
    }

    public function storeSupply()
    {
        $labSupplyModel = new LabSupplyModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'type' => $this->request->getPost('type'),
            'manufacturer' => $this->request->getPost('manufacturer'),
            'batch_number' => $this->request->getPost('batch_number'),
            'expiry_date' => $this->request->getPost('expiry_date') ?: null,
            'quantity' => $this->request->getPost('quantity'),
            'unit' => $this->request->getPost('unit'),
            'unit_price' => $this->request->getPost('unit_price'),
            'min_stock_level' => $this->request->getPost('min_stock_level'),
            'supplier' => $this->request->getPost('supplier'),
            'location' => $this->request->getPost('location'),
            'storage_conditions' => $this->request->getPost('storage_conditions'),
            'status' => 'active',
        ];

        $labSupplyModel->insert($data);
        return redirect()->to('/lab/supplies')->with('success', 'Lab supply added successfully');
    }

    public function editSupply($id)
    {
        $labSupplyModel = new LabSupplyModel();
        $data['supply'] = $labSupplyModel->find($id);
        return view('auth/lab/supply_form', $data);
    }

    public function updateSupply($id)
    {
        $labSupplyModel = new LabSupplyModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'category' => $this->request->getPost('category'),
            'type' => $this->request->getPost('type'),
            'manufacturer' => $this->request->getPost('manufacturer'),
            'batch_number' => $this->request->getPost('batch_number'),
            'expiry_date' => $this->request->getPost('expiry_date') ?: null,
            'quantity' => $this->request->getPost('quantity'),
            'unit' => $this->request->getPost('unit'),
            'unit_price' => $this->request->getPost('unit_price'),
            'min_stock_level' => $this->request->getPost('min_stock_level'),
            'supplier' => $this->request->getPost('supplier'),
            'location' => $this->request->getPost('location'),
            'storage_conditions' => $this->request->getPost('storage_conditions'),
        ];

        $labSupplyModel->update($id, $data);
        return redirect()->to('/lab/supplies')->with('success', 'Lab supply updated successfully');
    }

    public function deleteSupply($id)
    {
        $labSupplyModel = new LabSupplyModel();
        $labSupplyModel->delete($id);
        return redirect()->to('/lab/supplies')->with('success', 'Lab supply deleted successfully');
    }

    public function updateRequestStatus($id)
    {
        $labRequestModel = new LabRequestModel();
        $status = $this->request->getPost('status');
        $labRequestModel->update($id, ['status' => $status]);
        return redirect()->to('/lab/requests')->with('success', 'Request status updated successfully');
    }

    public function viewRequest($id)
    {
        $labRequestModel = new LabRequestModel();
        $request = $labRequestModel->find($id);
        
        if (!$request) {
            return redirect()->to('/lab/requests')->with('error', 'Lab request not found');
        }
        
        $data['request'] = $request;
        return view('auth/lab/request_view', $data);
    }

    public function addResult($requestId)
    {
        $labRequestModel = new LabRequestModel();
        $request = $labRequestModel->find($requestId);
        
        if (!$request) {
            return redirect()->to('/lab/requests')->with('error', 'Lab request not found');
        }
        
        // Add patient_id and test_type to match what the view expects
        $request['patient_id'] = $request['patient']; // Use patient name as ID for now
        $request['test_type'] = $request['test'];
        
        $data['request'] = $request;
        return view('auth/lab/result_form', $data);
    }

    public function storeResult()
    {
        $labResultModel = new LabResultModel();

        // Get the request to get patient and test names
        $labRequestModel = new LabRequestModel();
        $request = $labRequestModel->find($this->request->getPost('request_id'));

        $data = [
            'patient' => $request['patient'] ?? $this->request->getPost('patient_id'),
            'test' => $request['test'] ?? $this->request->getPost('test_name'),
            'result' => $this->request->getPost('result_value') . ' ' . $this->request->getPost('unit') .
                       ' (Range: ' . $this->request->getPost('reference_range') . ')' .
                       ' - ' . $this->request->getPost('interpretation') .
                       (!empty($this->request->getPost('notes')) ? ' | Notes: ' . $this->request->getPost('notes') : ''),
        ];

        $labResultModel->insert($data);

        // Update request status
        $labRequestModel->update($this->request->getPost('request_id'), ['status' => 'completed']);

        return redirect()->to('/lab/results')->with('success', 'Lab result added successfully');
    }

    public function viewResult($id)
    {
        $labResultModel = new LabResultModel();
        $result = $labResultModel->find($id);

        if (!$result) {
            return $this->response->setJSON(['error' => 'Lab result not found'])->setStatusCode(404);
        }

        return $this->response->setJSON($result);
    }
}
