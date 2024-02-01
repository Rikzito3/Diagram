<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Projects;

class ProjectsController
{
    public function __construct(
        private $projectsResource = new Projects()
    ) {
    }

    public function index()
    {
        return $this->projectsResource->listProjects();
    }

    public function store($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->projectsResource->createProject($data);
    }

    public function update($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Project ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->projectsResource->updateProject($id, $data);
    }

    public function destroy($id)
    {
        if (empty($id)) {
            return ['error' => 'Project ID is required'];
        }

        return $this->projectsResource->desactivateProject($id);
    }
}
