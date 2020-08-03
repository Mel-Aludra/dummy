<?php

class User extends Entity
{

    //Attributs.
    private $login;
    private $email;
    private $password;
    private $log;

    //Getters / Setters.
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getLog()
    {
        if($this->log === null) {
            $m = new LogManager();
            $this->setLog($m->findBy("User_Id", "=", $this->getId(), ["Id", "Desc"], 50));
        }
        return $this->log;
    }

    public function setLog(array $log)
    {
        $this->log = $log;
    }

}