<?php
abstract class Entity
{
    //Attributs
    protected $id;
    protected $childEntityIds = []; //On stocke les IDs pour retrouver les relations

    //Getters & Setters
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getChildEntityIds()
    {
        return $this->childEntityIds;
    }

    public function addChildEntityIds($key, $value)
    {
        $this->childEntityIds[$key] = $value;
    }

    protected function getChildEntity($childEntityName)
    {
        $attributeName = lcfirst($childEntityName);
        if($this->$attributeName !== null) {
            return $this->$attributeName;
        }
        foreach($this->getChildEntityIds() as $entityName => $entityId) {
            if($entityName === $childEntityName) {
                $childEntityManagerName = $childEntityName . "Manager";
                $childEntityManager = new $childEntityManagerName();

                $childEntity = $childEntityManager->find($entityId);
                if($childEntity !== null) {
                    $setterName = "set" . $childEntityName;
                    $this->$setterName($childEntity);
                }
            }
        }
        return $this->$attributeName;
    }

    protected function hydrateProcess($data)
    {
        foreach($data as $key => $value)
        {
            //Check si un setter correspond à chaque clé et si oui l'appelle pour tout bien setter comme un grand
            $setter = "set" . ucfirst($key);
            if(method_exists($this, $setter)) {
                $this->$setter($value);
            }
            elseif(strpos($key,"_Id") !== false) {
                $this->addChildEntityIds(str_replace("_Id","",$key),$value);
            }
        }
    }

    public function __construct($data)
    {
        $this->hydrateProcess($data);
    }

}