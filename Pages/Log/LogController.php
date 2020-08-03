<?php
class LogController extends Controller
{
    public function __construct(Log $log = null)
    {

        //S'il n'y a pas de log dans le construct, on tente d'en récupérer avec les données en GET.
        if(is_null($log) && isset($_GET["LogId"])) {
            $logManager = new LogManager();
            $log = $logManager->find($_GET["LogId"]);
        }

        //On enregistre les données dans le controller et on génère la vue.
        $this->addData("Log", $log);
        $view = new LogView($this->getData());
        $view->getView();

    }
}