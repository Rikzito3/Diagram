<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Banks;

class BanksController
{
    private $bancosResource;

    public function __construct()
    {
        $this->bancosResource = new Banks();
    }

    public function listBanks()
    {
        return $this->bancosResource->listBanks();
    }

    public function createBank($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->bancosResource->createBank($data);
    }

    public function updateBank($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Bank ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->bancosResource->updateBanks($id, $data);
    }

    public function desactivateBank($id)
    {
        if (empty($id)) {
            return ['error' => 'Bank ID is required'];
        }

        return $this->bancosResource->desactivateBank($id);
    }
}
