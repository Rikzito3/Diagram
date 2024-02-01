<?php

namespace Ipeweb\Diagram\Resources;

use Ipeweb\Diagram\Resources\BaseResource\BaseResource;

class Projects extends BaseResource
{

    public function __construct()
    {
        parent::__construct('projects');
    }

    public function listProjects()
    {
        // print "\nlistItems";
        return $this->listItems();
    }

    public function createProject($data)
    {
        return $this->createItem($data);
    }

    public function updateProject($id, $data)
    {
        return $this->updateItem($id, $data);
    }

    public function desactivateProject($id)
    {
        return $this->desactivateItem($id);
    }
}
