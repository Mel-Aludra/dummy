<?php
class Log extends Entity
{

    //Attributes
    protected $user;
    protected $dummyJob;
    private $maxHp;
    private $remainingHp;
    private $remainingTime;
    private $dps;
    private $killed;
    private $creationDate;
    private $currentIlvl;

    //Getters & Setters
    public function getUser()
    {
        return $this->getChildEntity("User");
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getDummyJob()
    {
        return $this->getChildEntity("DummyJob");
    }

    public function setDummyJob($dummyJob)
    {
        $this->dummyJob = $dummyJob;
    }

    public function getMaxHp()
    {
        return $this->maxHp;
    }

    public function setMaxHp($maxHp)
    {
        $this->maxHp = $maxHp;
    }

    public function getRemainingHp()
    {
        return $this->remainingHp;
    }

    public function setRemainingHp($remainingHp)
    {
        $this->remainingHp = $remainingHp;
    }

    public function getRemainingTime()
    {
        return $this->remainingTime;
    }

    public function setRemainingTime($remainingTime)
    {
        $this->remainingTime = $remainingTime;
    }

    public function getDps()
    {
        return $this->dps;
    }

    public function setDps($dps)
    {
        $this->dps = $dps;
    }

    public function getKilled()
    {
        return $this->killed;
    }

    public function setKilled($killed)
    {
        $this->killed = $killed;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getCurrentIlvl()
    {
        return $this->currentIlvl;
    }

    public function setCurrentIlvl($currentIlvl)
    {
        $this->currentIlvl = $currentIlvl;
    }
}