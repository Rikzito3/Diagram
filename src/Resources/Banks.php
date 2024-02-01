<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Banks extends BaseResource
{
    public function __construct()
    {
        parent::__construct('banks');
    }

    public function listBanks()
    {
        return $this->listItems();
    }

    public function createBank($data)
    {
        return $this->createItem($data);
    }

    public function updateBanks($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateBank($id)
    {
        return $this->desactivateItem($id);
    }
}
