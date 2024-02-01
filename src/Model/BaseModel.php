<?php

namespace Ipeweb\Diagram\Model;

use Ipeweb\Diagram\Repository\BaseRepository;
use PDO, PDOException;

class BaseModel
{
    protected $repository;
    protected $attributes = [];

    public function __construct(BaseRepository $repository, array $attributes = [])
    {
        $this->repository = $repository;
        $this->attributes = $attributes;
    }

    public function save()
    {
        if ($this->exists()) {
            $this->repository->update($this->attributes, $this->getId());
        } else {
            $this->repository->create($this->attributes);
        }
    }

    public function delete()
    {
        if ($this->exists()) {
            $this->repository->delete($this->getId());
        }
    }

    protected function getId()
    {
        return $this->attributes['id'] ?? null;
    }

    public function exists()
    {
        return !empty($this->getId());
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function hasMany($relatedModel, $foreignKey)
    {
        $relatedRepository = new $relatedModel($this->repository, '');
        return $relatedRepository->getByForeignKey($foreignKey, $this->getId());
    }
}
