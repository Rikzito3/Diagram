<?php

namespace Ipeweb\Diagram\Controllers;

use Ipeweb\Diagram\Resources\Exports;

class ExportsController
{
    public function __construct(
        private $exportsResource = new Exports()
    ) {
    }

    public function index()
    {
        return $this->exportsResource->listExports();
    }

    public function store($data)
    {
        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->exportsResource->createExports($data);
    }

    public function update($id, $data)
    {
        if (empty($id)) {
            return ['error' => 'Export ID is required'];
        }

        if (empty($data)) {
            return ['error' => 'Data is empty'];
        }

        return $this->exportsResource->updateExport($id, $data);
    }

    public function destroy($id)
    {
        if (empty($id)) {
            return ['error' => 'Export ID is required'];
        }

        return $this->exportsResource->desactivateExport($id);
    }
}
