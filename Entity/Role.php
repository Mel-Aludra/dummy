<?php
class Role extends Entity
{

    //Attributs.
    private $name;
    private $icon;
    private $globalRole;
    private $color;
    private $job;

    //Getters / Setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    public function getGlobalRole()
    {
        return $this->globalRole;
    }

    public function setGlobalRole($globalRole)
    {
        $this->globalRole = $globalRole;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function getJob()
    {
    }

    public function setJob()
    {
    }

}