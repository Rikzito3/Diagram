<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Diagrams extends BaseResource
{
    public function __construct()
    {
        parent::__construct('diagrams');
    }

    public function listDiagrams()
    {
        return $this->listItems();
    }

    public function createDiagram($data)
    {
        return $this->createItem($data);
    }

    public function updateDiagram($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateDiagram($id)
    {
        return $this->desactivateItem($id);
    }
}
