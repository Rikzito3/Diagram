<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\ElementsDiagrams;

class ElementsDiagramsController
{
    private $elementsDiagramsResource;

    public function __construct()
    {
        $this->elementsDiagramsResource = new ElementsDiagrams();
    }

    public function listElementsDiagrams()
    {
        return $this->elementsDiagramsResource->index();
    }

    public function createElementDiagram($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->elementsDiagramsResource->store($data);
    }

    public function updateElementDiagram($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Element ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->elementsDiagramsResource->update($id, $data);
    }

    public function desactivateElementDiagram($id)
    {
        if (empty($id)) {
            return ['error' => 'Element ID is required'];
        }

        return $this->elementsDiagramsResource->destroy($id);
    }
}
