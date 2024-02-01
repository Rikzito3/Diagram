<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Diagrams;

class DiagramsController
{
    private $diagramasResource;

    public function __construct()
    {
        $this->diagramasResource = new Diagrams();
    }

    public function listDiagrams()
    {
        return $this->diagramasResource->listDiagrams();
    }

    public function createDiagram($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->diagramasResource->createDiagram($data);
    }

    public function updateDiagram($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Diagram ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->diagramasResource->updateDiagram($id, $data);
    }

    public function desactivateDiagram($id)
    {
        if (empty($id)) {
            return ['error' => 'Diagram ID is required'];
        }

        return $this->diagramasResource->desactivateDiagram($id);
    }
}
