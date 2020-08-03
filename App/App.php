<?php
class App
{
    //Attributs
    private $db;
    private $userLogged = null;
    public $currentPage = null;
    const SITE_ACTIVE = true;

    //Fonctions
    public function __construct()
    {
        if(!self::SITE_ACTIVE)
            new ErrorController("Unavailable", true);
        session_start();
        $this->setDb();
    }

    public function retrieveUserFromSession()
    {
        if(isset($_SESSION["userId"]) && $_SESSION["userId"] !== null) {
            $userManager = new UserManager();
            $user = $userManager->find($_SESSION["userId"]);
            $this->setUserLogged($user);
        }
    }

    public function destroySession()
    {
        unset($_SESSION['userId']);
        $this->userLogged = null;
    }

    public function getDb()
    {
        return $this->db;
    }

    public function setDb()
    {
        $dbAccess = new DbAccess();
        $this->db = $dbAccess->setDbAccess();
    }

    public function launch()
    {
        if(isset($_GET['page'])) {
            $this->generatePage($_GET['page']);
        }
        else {
            $this->generatePage("Home");
        }
    }

    public function generatePage($pageName)
    {
        $pageControllerName = $pageName . "Controller";
        if(class_exists($pageControllerName)) {
            if (!$this->accessGranted($pageName)) {
                $this->currentPage = "Error";
                new ErrorController("Access denied. Please log in.");
            }
            $this->currentPage = $pageName;
            new $pageControllerName();
        }
        else {
            $this->currentPage = "Error";
            new ErrorController("404 not found.");
        }
    }

    public function getUserLogged()
    {
        return $this->userLogged;
    }

    public function setUserLogged(User $user)
    {
        $this->userLogged = $user;
    }

    public function accessGranted($page)
    {
        $pagesLocked = [
            "Logs"
        ];

        if(in_array($page,$pagesLocked)) {
            if ($this->getUserLogged() !== null)
                return true;
            return false;
        }
        return true;
    }

}