<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Users extends BaseResource
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function listUsers()
    {
        return $this->listItems();
    }

    public function createUser($data)
    {
        return $this->createItem($data);
    }

    public function updateUser($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateUser($id)
    {
        return $this->desactivateItem($id);
    }
}
