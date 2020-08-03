<?php
abstract class Manager
{

    use Tools;

    //Méthode de récupération
    public function find($id)
    {
        //Cherche un élément dans la table qui porte le nom de l'entité
        $query = $GLOBALS['app']->getDb()->prepare("
            SELECT * FROM " . $this->managerToTableName() . "
            WHERE Id = :id
        ");
        $query->bindValue(":id", $id);
        $query->execute();

        $entityName = $this->managerToEntityName();

        //Renvoie un nouvel objet avec les données récupérées en base
        $result = $query->fetch();
        if($result == false) {
            return null;
        }
        return new $entityName($result);
    }

    public function findBy($field, $operator, $value, $orderClause = ["Id", "ASC"], $limit = null)
    {
        $limitClause = "";
        if($limit !== null)
            $limitClause = "LIMIT " . $limit;

        $query = $GLOBALS['app']->getDb()->query("
            SELECT * FROM " . $this->managerToTableName() .
            " WHERE " . $field . " " . $operator . " " . $value .
            " ORDER BY " . $orderClause[0] . " " . $orderClause[1]
            . " " . $limitClause
        );

        $entities = [];
        $entityName = $this->managerToEntityName();
        while ($line = $query->fetch()){
            $entities[] = new $entityName($line);
        }

        return $entities;
    }

    public function findAll($orderClause = ["Id", "ASC"])
    {
        $query = $GLOBALS['app']->getDb()->query("
            SELECT * FROM " . $this->managerToTableName() .
            " ORDER BY " . $orderClause[0] . " " . $orderClause[1]
        );

        $entities = [];
        $entityName = $this->managerToEntityName();
        while ($line = $query->fetch()){
            $entities[] = new $entityName($line);
        }

        return $entities;

    }

    //Renvoie le nom de la table en fonction du manager courant
    protected function managerToTableName()
    {
        return strtolower(preg_replace('/\B([A-Z])/', '_$1',$this->managerToEntityName()));
    }

    //Renvoie le nom de l'entité en fonction du manager courant
    protected function managerToEntityName()
    {
        return str_replace("Manager","",get_class($this));
    }
}