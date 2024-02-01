<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class ElementsDiagrams extends BaseResource
{
    public function __construct()
    {
        parent::__construct('elementsdiagrams');
    }

    public function index()
    {
        return $this->listItems();
    }

    public function store($data)
    {
        return $this->createItem($data);
    }

    public function update($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function destroy($id)
    {
        return $this->desactivateItem($id);
    }
}
