<?php

namespace App\Controllers;

use App\Models\UserModel;

class UsersController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('admin/users', $data);
    }

    public function create()
    {
        return view('admin/users_create');
    }

    public function store()
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'name' => $this->request->getPost('name'),
        ];

        $this->userModel->insert($data);
        return redirect()->to('/admin/users');
    }

    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id);
        return view('admin/users_edit', $data);
    }

    public function update($id)
    {
        $data = [
            'email' => $this->request->getPost('email'),
            'role' => $this->request->getPost('role'),
            'name' => $this->request->getPost('name'),
        ];

        if ($this->request->getPost('password')) {
            $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);
        return redirect()->to('/admin/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/admin/users');
    }
}
