<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table            = 'staff';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'email',
        'role',
        'department',
        'specialization',
        'contact',
        'address',
        'salary',
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
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[staff.email,id,{id}]',
        'role'     => 'required|in_list[admin,doctor,nurse,receptionist,accountant,it_staff,lab_technician,pharmacist]',
        'contact'  => 'permit_empty|max_length[20]',
        'address'  => 'permit_empty|max_length[255]',
        'salary'   => 'permit_empty|decimal|greater_than[0]',
        'status'   => 'permit_empty|in_list[active,inactive,suspended]'
    ];

    protected $validationMessages = [
        'name' => [
            'required'    => 'Staff name is required',
            'min_length'  => 'Name must be at least 3 characters long',
            'max_length'  => 'Name cannot exceed 100 characters'
        ],
        'email' => [
            'required'    => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'is_unique'   => 'This email is already registered'
        ],
        'role' => [
            'required' => 'Role is required',
            'in_list'  => 'Please select a valid role'
        ],
        'salary' => [
            'decimal'       => 'Salary must be a valid decimal number',
            'greater_than'  => 'Salary must be greater than 0'
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
     * Get all staff with pagination
     */
    public function getStaff($limit = 10, $offset = 0)
    {
        return $this->findAll($limit, $offset);
    }

    /**
     * Get staff by ID
     */
    public function getStaffById($id)
    {
        return $this->find($id);
    }

    /**
     * Create new staff
     */
    public function createStaff($data)
    {
        return $this->insert($data);
    }

    /**
     * Update staff
     */
    public function updateStaff($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Delete staff
     */
    public function deleteStaff($id)
    {
        return $this->delete($id);
    }

    /**
     * Get staff by role
     */
    public function getStaffByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    /**
     * Get staff by status
     */
    public function getStaffByStatus($status)
    {
        return $this->where('status', $status)->findAll();
    }

    /**
     * Search staff by name or email
     */
    public function searchStaff($keyword)
    {
        return $this->like('name', $keyword)
                    ->orLike('email', $keyword)
                    ->findAll();
    }

    /**
     * Get total staff count
     */
    public function getTotalStaff()
    {
        return $this->countAll();
    }

    /**
     * Get staff by department
     */
    public function getStaffByDepartment($department)
    {
        return $this->where('department', $department)->findAll();
    }
}
