<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Users;

class UsersController
{
    private $usersResource;

    public function __construct()
    {
        $this->usersResource = new Users();
    }

    public function index()
    {
        return $this->usersResource->listUsers();
    }

    public function store($data)
    {
        // Validar os dados de entrada antes de criar o usuário
        if (isset($data['name']) && isset($data['email'])) {
            return $this->usersResource->createUser($data);
        } else {
            return ['error' => 'Validation Error', 'message' => 'Name and email are required.'];
        }
    }

    public function update($id, $data)
    {
        // Validar os dados de entrada antes de atualizar o usuário
        if (isset($data['name']) || isset($data['email'])) {
            return $this->usersResource->updateUser($id, $data);
        } else {
            return ['error' => 'Validation Error', 'message' => 'Name or email is required to update.'];
        }
    }

    public function destroy($id)
    {
        return $this->usersResource->desactivateUser($id);
    }
}
