<?php
class FightController extends Controller
{

    public function __construct()
    {

        //Il y a deux possibilités : soit on veut afficher le formulaire, soit on veut rediriger vers la page de logs.
        $logPageRedirection = false;

        //On vérifie s'il y a un post et on récupère les données du post.
        if(isset($_POST["fight"])) {
            $this->addData("PostReturn", $this->postFight($_POST["fight"]));
            if($this->getData()["PostReturn"][0])
                $logPageRedirection = true; //Si le post est ok, on redirigera vers la page de log.
        }

        //On génère la page qui nous intéresse en fonction de la redirection.

        //S'il n'y a pas de redirection, on génère la page courante (le formulaire).
        if(!$logPageRedirection) {

            //On récupère les données pour les ajouter aux data du controller.
            $jobManager = new JobManager();
            $dummyManager = new DummyManager();
            $dummyJobManager = new DummyJobManager();
            $dummyJob = $dummyJobManager->findAll();
            $this->addData("Jobs", $jobManager->sortJobsByRole($jobManager->findAll()));
            $this->addData("Dummies", $dummyManager->sortDummiesByExpansionThenByDifficulty($dummyManager->findAllDummiesSortedByReversePatchesAndAscendingFloors()));
            $this->addData("AvailableJobsByDummy", $dummyJobManager->getAvailableJobsByDummyMapping($dummyJob));
            $this->addData("AvailableDummiesByJob", $dummyJobManager->getAvailableDummiesByJobMapping($dummyJob));

            //On instancie la vue pour lui demander la page.
            $pageView = new FightView($this->getData());
            $pageView->getView();

        }

        //S'il y a une redirection, on instancie le controller du log et on génère la page en donnant le Log.
        else {
            new LogController($this->getData()["PostReturn"][1]);
        }

    }

    public function postFight($post)
    {
        //On vérifie l'intégrité des données envoyées.
        if(!isset($post["jobId"]) || !isset($post["dummyId"]) || (!isset($post["remainingHp"]) && !isset($post["remainingTime"])))
            return [false, "System error. Don't touch the DOM, please. *wink*"];

        //On cast les données.
        $jobId = (int) $post["jobId"];
        $dummyId = (int) $post["dummyId"];
        $remainingHp = (float) $post["remainingHp"];
        $remainingTime = (int) $post["remainingTime"];
        $currentIlvl = (int) $post["currentIlvl"];

        //On vérifie le type des données.
        if($jobId === 0 || $dummyId === 0)
            return [false, "Please choose a job and a dummy."];
        if($remainingHp > 100)
            return [false, "Remaining hp can't be over 100%."];

        //Si le ilvl n'est pas correct on le set à null
        if($currentIlvl === 0)
            $currentIlvl = null;

        //On récupère le dummy job.
        $dummyJobManager = new DummyJobManager();
        $dummyJob = $dummyJobManager->findDummyJob($dummyId, $jobId);
        if($dummyJob === null)
            return [false, "This dummy isn't available."];

        //On demande le calcul.
        $logManager = new LogManager();
        $log = $logManager->createLogFromPost($dummyJob, $remainingHp, $remainingTime, $currentIlvl);

        //On retourne la donnée.
        if($log === null)
            return [false, "Calculation fail."];
        return [true, $log];

    }

}