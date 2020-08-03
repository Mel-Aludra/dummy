<?php
class RaidTier extends Entity
{
    //Attributs
    private $name;
    private $extension;
    private $patch;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getExtensionName()
    {
        $expansion = [
            "3" => "Heavensward",
            "4" => "Stormblood",
            "5" => "Shadowbringers"
        ];

        if(!isset($expansion[$this->getExtension()]))
            return null;

        return $expansion[$this->getExtension()];
    }

    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    public function getPatch()
    {
        return $this->patch;
    }

    public function setPatch($patch)
    {
        $this->patch = $patch;
    }


}