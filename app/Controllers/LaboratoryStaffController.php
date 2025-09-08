<?php

namespace App\Controllers;

use App\Models\LabRequestModel;
use App\Models\LabResultModel;
use App\Models\LabRecordModel;

class LaboratoryStaffController extends BaseController
{
    protected $requestModel;
    protected $resultModel;
    protected $recordModel;

    public function __construct()
    {
        $this->requestModel = new LabRequestModel();
        $this->resultModel  = new LabResultModel();
        $this->recordModel  = new LabRecordModel();
    }

    private function checkAuth()
    {
        if (!$this->session->get('isLoggedIn') || $this->session->get('role') !== 'labstaff') {
            return false;
        }
        return true;
    }

    public function dashboard()
    {
        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }

        $data = [
            'totalRequests'  => $this->requestModel->countAllResults(),
            'pendingTests'   => $this->requestModel->where('status', 'Pending')->countAllResults(),
            'completedTests' => $this->resultModel->countAllResults(),
            'criticalAlerts' => 0, // pwede mong i-compute based sa results table kung may "Critical"
        ];

        return view('lab/dashboard', $data);
    }

    public function testingRequests()
    {
        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }

        $data['requests'] = $this->requestModel->findAll();

        return view('lab/testing_requests', $data);
    }

    public function results()
    {
        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }

        $data['results'] = $this->resultModel->findAll();

        return view('lab/results', $data);
    }

    public function saveResult()
    {
        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }

        $patient = trim($this->request->getPost('patient') ?? '');
        $test    = trim($this->request->getPost('test') ?? '');
        $result  = trim($this->request->getPost('result') ?? '');

        if ($patient === '' || $test === '' || $result === '') {
            return redirect()->back()->with('error', 'Please fill all fields.');
        }

        // Save into lab_results
        $this->resultModel->save([
            'patient' => $patient,
            'test'    => $test,
            'result'  => $result,
        ]);

        // Also save into lab_records (history)
        $this->recordModel->save([
            'patient' => $patient,
            'test'    => $test,
            'date'    => date('Y-m-d'),
        ]);

        return redirect()->to('/lab/results')->with('success', 'Result saved successfully.');
    }

    public function records()
    {
        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }

        $data['records'] = $this->recordModel->findAll();

        return view('lab/records', $data);
    }
}
