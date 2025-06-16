<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'password_hash',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;

    /**
     * Create a new user with hashed password.
     *
     * @param array $data ['name' => ..., 'email' => ..., 'password' => ...]
     * @return int|string|false Insert ID on success, false on failure.
     */
    public function createUser(array $data)
    {
        $dataToInsert = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
        ];
        return $this->insert($dataToInsert);
    }
}
