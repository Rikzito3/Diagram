<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Exports extends BaseResource
{
    public function __construct()
    {
        parent::__construct('exports');
    }

    public function listExports()
    {
        return $this->listItems();
    }

    public function createExports($data)
    {
        return $this->createItem($data);
    }

    public function updateExport($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateExport($id)
    {
        return $this->desactivateItem($id);
    }
}
