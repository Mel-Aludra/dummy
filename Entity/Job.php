<?php
class Job extends Entity
{
    //Attributs
    private $name;
    protected $role;
    private $icon;

    //Getters & Setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRole()
    {
        return $this->getChildEntity("Role");
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

}