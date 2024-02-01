<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Atribucts extends BaseResource
{
    public function __construct()
    {
        parent::__construct('atribucts');
    }

    public function listAtribucts()
    {
        return $this->listItems();
    }

    public function createAtribuct($data)
    {
        return $this->createItem($data);
    }

    public function updateAtribucts($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateAtribuct($id)
    {
        return $this->desactivateItem($id);
    }
}
