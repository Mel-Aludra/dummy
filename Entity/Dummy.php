<?php
class Dummy extends Entity
{

    //Attributs
    private $name;
    protected $raidTier;
    private $floor;
    private $time;
    private $dummyJob;

    //Getters & Setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRaidTier()
    {
        return $this->getChildEntity("RaidTier");
    }

    public function setRaidTier($raidTier)
    {
        $this->raidTier = $raidTier;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function setFloor($floor)
    {
        $this->floor = $floor;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getDummyJob()
    {
        if($this->dummyJob === null) {
            $m = new DummyJobManager();
            $this->setDummyJob($m->findBy("Dummy_Id", "=", $this->getId()));
        }
        return $this->dummyJob;
    }

    public function setDummyJob(array $dummyJob)
    {
        $this->dummyJob = $dummyJob;
    }

}