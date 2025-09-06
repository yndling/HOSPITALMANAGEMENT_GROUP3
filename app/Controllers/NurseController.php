<?php

namespace App\Controllers;

class NurseController extends BaseController
{
    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'nurse') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample statistics data
        $data = [
            'tasksCompleted' => 10,
            'tasksPending' => 5,
            'tasksInProgress' => 3,
        ];

        return view('nurse/dashboard', $data);
    }

    public function patients()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'nurse') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample patients data
        $data = [
            'patients' => [
                ['name' => 'John Doe', 'room' => '101', 'condition' => 'Stable', 'doctor' => 'Dr. Smith'],
                ['name' => 'Jane Smith', 'room' => '102', 'condition' => 'Critical', 'doctor' => 'Dr. Adams'],
                ['name' => 'Bob Johnson', 'room' => '103', 'condition' => 'Recovering', 'doctor' => 'Dr. Lee'],
            ],
        ];

        return view('nurse/patients', $data);
    }

    public function appointments()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'nurse') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        // Sample appointments data
        $data = [
            'appointments' => [
                ['time' => '09:00 AM', 'patient' => 'John Doe', 'doctor' => 'Dr. Smith', 'room' => '101'],
                ['time' => '10:30 AM', 'patient' => 'Jane Smith', 'doctor' => 'Dr. Adams', 'room' => '102'],
                ['time' => '01:00 PM', 'patient' => 'Bob Johnson', 'doctor' => 'Dr. Lee', 'room' => '103'],
            ],
        ];

        return view('nurse/appointments', $data);
    }

    public function medications()
    {
        if (!$this->session->get('isLoggedIn') || strtolower($this->session->get('role')) !== 'nurse') {
            return redirect()->to('/login')->with('error', 'Not your role');
        }

        return view('nurse/medications');
    }
}
