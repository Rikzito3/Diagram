<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Atribucts;

class AtribuctsController
{
    private $atribuctsResource;

    public function __construct()
    {
        $this->atribuctsResource = new Atribucts();
    }

    public function index()
    {
        return $this->atribuctsResource->listAtribucts();
    }

    public function store($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->atribuctsResource->createAtribuct($data);
    }

    public function update($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Atribuct ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->atribuctsResource->updateAtribucts($id, $data);
    }

    public function destroy($id)
    {
        if (empty($id)) {
            return ['error' => 'Atribuct ID is required'];
        }

        return $this->atribuctsResource->desactivateAtribuct($id);
    }
}
