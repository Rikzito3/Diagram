<?php

class Entity
{
    public $name;
    public $type;
    public $attributes;

    public function __construct($name, $type, $attributes)
    {
        $this->name = $name;
        $this->type = $type;
        $this->attributes = $attributes;
    }
}

class ERDiagram
{
    public $entities = [];

    public function addEntity(Entity $entity)
    {
        $this->entities[] = $entity;
    }

    public function addRelationship($entityName1, $entityName2, $relationshipType)
    {
        $entity1 = null;
        $entity2 = null;
        foreach ($this->entities as $entity) {
            if ($entity->name === $entityName1) {
                $entity1 = $entity;
            }
            if ($entity->name === $entityName2) {
                $entity2 = $entity;
            }
        }

        if ($entity1 === null || $entity2 === null) {
            echo "Erro: Uma das entidades não existe no diagrama.\n";
            return;
        }

        $relationship = "$entityName1-$entityName2: $relationshipType";
        $entity1->relationships[] = $relationship;
        $entity2->relationships[] = $relationship;

        echo "Relacionamento adicionado entre $entityName1 e $entityName2 do tipo $relationshipType\n";
    }

    public function setPrimaryKey($entityName, $primaryKey)
    {
        $entityFound = false;
        foreach ($this->entities as $entity) {
            if ($entity->name === $entityName) {
                $entity->primaryKey = $primaryKey;
                $entityFound = true;
                break;
            }
        }

        if (!$entityFound) {
            echo "Erro: A entidade $entityName não foi encontrada no diagrama.\n";
        } else {
            echo "Chave primária definida como $primaryKey na entidade $entityName\n";
        }
    }

    public function setForeignKey($entityName, $foreignKey, $referencedEntity, $referencedKey)
    {
        $entityFound = false;
        foreach ($this->entities as $entity) {
            if ($entity->name === $entityName) {
                $entity->foreignKeys[] = [
                    'name' => $foreignKey,
                    'referencedEntity' => $referencedEntity,
                    'referencedKey' => $referencedKey
                ];
                $entityFound = true;
                break;
            }
        }

        if (!$entityFound) {
            echo "Erro: A entidade $entityName não foi encontrada no diagrama.\n";
        } else {
            echo "Chave estrangeira $foreignKey definida na entidade $entityName, referenciando $referencedEntity.$referencedKey\n";
        }
    }

    public function setAttributeType($entityName, $attributeName, $attributeType)
    {
        $entityFound = false;
        foreach ($this->entities as $entity) {
            if ($entity->name === $entityName) {
                if (in_array($attributeName, $entity->attributes)) {
                    $entity->attributeTypes[$attributeName] = $attributeType;
                    $entityFound = true;
                    break;
                } else {
                    echo "Erro: O atributo $attributeName não existe na entidade $entityName.\n";
                    return;
                }
            }
        }

        if (!$entityFound) {
            echo "Erro: A entidade $entityName não foi encontrada no diagrama.\n";
        } else {
            echo "Tipo de dado $attributeType definido para o atributo $attributeName na entidade $entityName\n";
        }
    }

    public function removeEntity($name)
    {
        foreach ($this->entities as $key => $entity) {
            if ($entity->name === $name) {
                unset($this->entities[$key]);
                echo "Entidade $name removida do diagrama\n";
                return;
            }
        }

        echo "Erro: Entidade $name não encontrada no diagrama\n";
    }


    public function export($format)
    {
        switch ($format) {
            case 'sql':
                echo "Exportando diagrama como SQL...\n";
                break;
            case 'png':
                echo "Exportando diagrama como PNG...\n";
                break;
            case 'pdf':
                echo "Exportando diagrama como PDF...\n";
                break;
            default:
                echo "Formato inválido\n";
        }
    }
}
