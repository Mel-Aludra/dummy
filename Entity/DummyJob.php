<?php
class DummyJob extends Entity
{
    //Attributs
    protected $dummy;
    protected $job;
    private $maxHp;

    //Getters & Setters
    public function getDummy()
    {
        return $this->getChildEntity("Dummy");
    }

    public function setDummy($dummy)
    {
        $this->dummy = $dummy;
    }

    public function getJob()
    {
        return $this->getChildEntity("Job");
    }

    public function setJob($job)
    {
        $this->job = $job;
    }

    public function getMaxHp()
    {
        return $this->maxHp;
    }

    public function setMaxHp($maxHp)
    {
        $this->maxHp = $maxHp;
    }

    public function getDpsRequired()
    {
        if($this->getDummy()->getTime() == null )
            return null;
        return round($this->getMaxHp() / $this->getDummy()->getTime(), 2);
    }

}