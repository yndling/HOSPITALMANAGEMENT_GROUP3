<?php

namespace App\Controllers;

use App\Models\PatientModel;
use CodeIgniter\Controller;

class PatientController extends Controller
{
    protected $patientModel;

    public function __construct()
    {
        $this->patientModel = new PatientModel();
    }

    // ✅ READ: List of patients
    public function index()
    {
        $data['patients'] = $this->patientModel->findAll();
        return view('patients/index', $data);
    }

    // ✅ CREATE: Show form
    public function create()
    {
        return view('patients/create');
    }

    // ✅ STORE: Save new patient
    public function store()
    {
        $this->patientModel->save([
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'phone'   => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/patients');
    }

    // ✅ EDIT: Show form with data
    public function edit($id)
    {
        $data['patient'] = $this->patientModel->find($id);
        return view('patients/edit', $data);
    }

    // ✅ UPDATE: Save changes
    public function update($id)
    {
        $this->patientModel->update($id, [
            'name'    => $this->request->getPost('name'),
            'age'     => $this->request->getPost('age'),
            'gender'  => $this->request->getPost('gender'),
            'address' => $this->request->getPost('address'),
            'phone'   => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/patients');
    }

    // ✅ DELETE: Hard delete patient
    public function delete($id)
    {
        $this->patientModel->delete($id);
        return redirect()->to('/patients');
    }
}
